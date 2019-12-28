<?php

namespace app\cofco\admin;

use app\cofco\model\AdminLevellabel as LevellabelModel;
use think\Db;

class Statistic extends AdminBase
{
    /*
     * 数据标注说明
     * */
    public function index()
    {
        $welcome_html = config('dataanalyse.dataanalyse_welcome_info');
        $this->assign('welcome_html', $welcome_html);
        return $this->fetch();
    }

    /**
     * 标签列表
     * @return string
     */
    public function count()
    {
        if (!$this->request->isPost()) {

            $this->assign('dispaly_statistic', '0');
            return $this->fetch();
        }

        $jibingtype_arr = explode("#", $this->request->post('jibingtype'));
        $yuanliaotype_arr = explode("#", $this->request->post('yuanliaotype'));

        $jibing_idstr = $this->request->post('jibingtype');
        if (empty($jibing_idstr)) {
            # 疾病所有的ID
            $jibing_all_ids = Db::table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('id', 3)->field('id');
            })->whereOr('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('id', 3)->whereOr('cid', 'IN', function ($query) {
                    $query->table('cofco_admin_levellabel')->where('id', 3)->field('id');
                })->field('id');
            })->column('id');
            $jibingtype_arr = $jibing_all_ids;
        }

        $yuanliao_idstr = $this->request->post('yuanliaotype');
        if (empty($yuanliao_idstr)) {
            $yuanliao_all_ids = Db::table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('id', 4)->field('id');
            })->whereOr('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('id', 4)->whereOr('cid', 'IN', function ($query) {
                    $query->table('cofco_admin_levellabel')->where('id', 4)->field('id');
                })->field('id');
            })->column('id');
            $yuanliaotype_arr = $yuanliao_all_ids;
        }

        # 实验类型标签的下方的所有ID
        $shiyan_all_ids = Db::table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
            $query->table('cofco_admin_levellabel')->where('id', 2)->field('id');
        })->whereOr('cid', 'IN', function ($query) {
            $query->table('cofco_admin_levellabel')->where('id', 2)->whereOr('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('id', 2)->field('id');
            })->field('id');
        })->column('id');

        # 从实验类型总和与原料下的每个实验类型的角度进行统计
        $inner_statistic_info = []; # 柱状图统计信息
        $shiyan_names = LevellabelModel::where('id', 'IN', $shiyan_all_ids)->column('value');
        $level_info = array();
        $shiyanfenzu = array();
        foreach ($shiyan_names as $v) {
            $inner_statistic_info[$v] = [];
            $inner_statistic_info[$v]['inner_percent'] = [];
            $shiyanfenzu[$v]['number'] = array();
            $level_info[$v] = LevellabelModel::get(['value' => $v])->toArray();
            $level_info[$v]['p_total_number'] = 0;
        }

        # 从原料角度进行统计
        $yuanliaonames = LevellabelModel::where('id', 'IN', $yuanliaotype_arr)->column('value');
        $yuanliao_statistic_info = [];
        foreach ($yuanliaonames as $v) {
            $yuanliao_statistic_info[$v] = LevellabelModel::get(['value' => $v])->toArray();
            $yuanliao_statistic_info[$v]['p_total_number'] = 0;
        }

        $query_yuanliao = LevellabelModel::where('id', 'IN', $yuanliaotype_arr)->select();
        foreach ($query_yuanliao as $keykk => $vvv) {
            $item = $vvv['id'];
            $yuanliao_name = $vvv['value'];
            #统计所有实验类型数目
            $result = Db::table('cofco_admin_article_label ai')
                ->join(['cofco_admin_levellabel'=>'ll'], 'ai.label_id = ll.id')
                ->where('ai.art_id', "IN",
                    function ($query) use ($item, $jibingtype_arr) {
                        $query->table('cofco_admin_article_label')
                            ->where('art_id', 'IN', function ($query) use ($item) {
                                $query->table('cofco_admin_article_label')->where('label_id', $item)->field('art_id');
                            })
                            ->where('label_id', 'IN', $jibingtype_arr)
                            ->field('art_id');
                    })
                ->where('ai.label_id', 'IN', $shiyan_all_ids)
                ->group('art_id')
                ->field('ai.label_id, ll.value, count(ai.art_id) count')
                ->select();

            $yuanliao_p_number = 0;
            foreach ($shiyanfenzu as $name => $arr) {

                #  默认为0，因为result中不一定含有该实验的值
                $count = 0;
                foreach ($result as $k => $v) {
                    if ($v['value'] == $name) {
                        $count = $v['count'];
                        break;
                    }
                }
                $level_info[$name]['p_total_number'] += $count;
//                $score = LevellabelModel::where('value',$name)->find()->toArray()['score'];
                array_push($shiyanfenzu[$name]['number'], $count);
                $yuanliao_p_number += $count;
            }
            $yuanliao_statistic_info[$yuanliao_name]['p_total_number'] = $yuanliao_p_number;
        }

        # 统计总数量
        $statistic_info = [];
        $statistic_info['total_p'] = 0;
        $statistic_info['total_score'] = 0;
        $statistic_info['max_score'] = -1;
        $statistic_info['max_name'] = '出错了';
        foreach ($level_info as $name => $value) {
            $ss = $value['p_total_number'] * $value['score'];
            if ($ss > $statistic_info['max_score']) {
                $statistic_info['max_score'] = $ss;
                $statistic_info['max_name'] = $name;
            }
            $statistic_info['total_p'] += $value['p_total_number'];
            $statistic_info['total_score'] += $ss;
        }

        #处理表格百分比
        foreach ($level_info as $name => $value) {
            $level_info[$name]['percent'] = $statistic_info['total_p'] == 0 ? 0 : round(100.0 * $value['p_total_number'] / $statistic_info['total_p'], 2);
        }


        #处理柱状图百分比
        $sum_grout = [];
        for ($i = 0; $i < sizeof($yuanliaonames); $i++) {
            $sum_t = 0;
            foreach ($shiyanfenzu as $name => $value) {
                $sum_t += $value['number'][$i];
            }
            $sum_grout[$i] = $sum_t;
        }
        foreach ($shiyanfenzu as $name => $value) {
            $inner_percent = [];
            $i = 0;
            foreach ($value['number'] as $v) {
                $p = $sum_grout[$i] == 0 ? 0 : round(100.0 * $v / $sum_grout[$i], 2);
                array_push($inner_percent, $p);
                $i++;
            }
            $shiyanfenzu[$name]['inner_percent'] = $inner_percent;
        }

        $this->assign('user_input', $this->request->post());
        $this->assign('shiyan_names', $shiyan_names);
        $this->assign('shiyanfenzu', $shiyanfenzu);
        $this->assign('yuanliao_statistic_info', $yuanliao_statistic_info);
        $this->assign('statistic_info', $statistic_info);
        $this->assign('level_info', $level_info);
        $this->assign('mingcheng', $yuanliaonames);
        $this->assign('dispaly_statistic', '1');
        return $this->fetch();
    }


    /***
     * 文献终审页面
     */
    public function final_auditor(){
        $this->init_searchForm();
        $this->assign('art_status', '3');
        return $this->fetch();
    }

    /***
     * 标签统计
     */
    public function label_statistic(){
        return $this->fetch();
    }


    /**
     * 关键词统计
     * @return string
     */

    public function keyword_statistic(){
        return $this->fetch();
    }


    public function levelpop1($q = '')
    {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        $map = [];
        if ($q) {
            $map['value'] = ['like', '%' . $q . '%'];
        } else
            $map['status'] = 1;

        $menu_list = LevellabelModel::getAllChildtj1(0, 0);
        //var_dump($menu_list[0]['childs']['1']);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        $this->assign('menu_list', $menu_list);
        $this->assign('dispaly_statistic', '1');
        return $this->fetch();
    }

    public function levelpop2($q = '')
    {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        $map = [];
        if ($q) {
            $map['value'] = ['like', '%' . $q . '%'];
        } else
            $map['status'] = 1;

        $menu_list = LevellabelModel::getAllChildtj2(0, 0);
        //var_dump($menu_list[0]['childs']['1']);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        $this->assign('menu_list', $menu_list);
        $this->assign('dispaly_statistic', '1');
        return $this->fetch();
    }

    public function grade(){

        return $this->fetch();
    }

    public function meta(){

        return $this->fetch();
    }

    /**
     * 标签年份统计图
     * @return string
     */
    public function label_year_count()
    {
        if (!$this->request->isPost()) {
            $this->assign('display_statistic', '0');
            return $this->fetch();
        }

        //原料列表里所有的 id 是 yuanliaotype，所有的 名字 是 yuanliaoname
        $yuanliaotype_arr = explode("#", $this->request->post('yuanliaotype'));
        $yuanliao_idstr = $this->request->post('yuanliaotype');
        $start_year=$this->request->post('start_year');
        $end_year=$this->request->post('end_year');
        if (empty($start_year)) $start_year="2010";
        if (empty($end_year)) $end_year="2019";
        if ($start_year>$end_year) {
            $this->assign('display_statistic', '0');
            return $this->fetch();
        }
//        var_dump($start_year>$end_year);

        if (empty($yuanliao_idstr)) {
            $yuanliao_all_ids = Db::table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('id', 1)->field('id');
            })->whereOr('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
                    $query->table('cofco_admin_levellabel')->where('id', 1)->field('id');
                })->field('id');
            })->column('id');
            $yuanliaotype_arr = $yuanliao_all_ids;
        }

        $query_yuanliao = LevellabelModel::where('id', 'IN', $yuanliaotype_arr)->select();
        foreach ($query_yuanliao as $keykk => $vvv) {
            $item = $vvv['id'];  #levellabel.id
            $result = Db::table('cofco_admin_content')
                ->where('art_id', 'IN',
                    function ($query) use ($item) {  #根据art_id查询所有 label_id=jibing.label_id(jibingtype_arr),返回art_id
                        $query->table('cofco_admin_article_label')->where('label_id', $item)->field('art_id'); #查询label_id($item)的所有字段的art_id
                    })
                ->where('LEFT(issue,4) >= '.$start_year.' and LEFT(issue,4) <= '.$end_year)
                ->group('LEFT(issue,4)')
                ->field('LEFT(issue,4) year,count(art_id) count')
                ->select();
            $a=array();
            for($i=$start_year;$i<=$end_year;$i++) {
                $flag=0;
                foreach ($result as $k => $v) {
                    if ($v['year'] == $i) {
                        array_push($a, $v['count']);
                        $flag=1;
                        break;
                    }
                }
                if($flag==0) array_push($a,0);
            }
            $yuanliao_year_info[$vvv['value']]['data']=$a;
        }
        $this->assign('user_input', $this->request->post());
        $this->assign('result', $yuanliao_year_info);
        $this->assign('startyear',$start_year);
        $this->assign('endyear',$end_year);
        $this->assign('display_statistic', '1');
        return $this->fetch();
    }

    /*
     * 标签年份统计图的标签选择界面的弹出窗口
     *
     */
    public function year_count_levelpop($q = '')
    {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        $map = [];
        if ($q) {
            $map['value'] = ['like', '%' . $q . '%'];
        } else
            $map['status'] = 1;

        $menu_list = LevellabelModel::getAllChild(0, 0);
//        var_dump($menu_list[0]['childs']['1']);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        $this->assign('menu_list', $menu_list);
        $this->assign('display_statistic', '1');
        return $this->fetch();
    }

    /*
     * 嵌套环形图统计
     */
    public function pie_count()
    {
        if (!$this->request->isPost()) {
            $this->assign('display_statistic', '0');
            return $this->fetch();
        }

        //原料列表里所有的 id 是 yuanliaotype，所有的 名字 是 yuanliaoname
        $yuanliaotype_arr = explode("#", $this->request->post('yuanliaotype'));
        $yuanliao_idstr = $this->request->post('yuanliaotype');
//        var_dump($start_year>$end_year);

        if (empty($yuanliao_idstr)) {
            $yuanliao_all_ids = Db::table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
                    $query->table('cofco_admin_levellabel')->where('id', 1)->field('id');
                })->field('id');
            })->whereOr('cid', 'IN', function ($query) {
                $query->table('cofco_admin_levellabel')->where('cid', 'IN', function ($query) {
                    $query->table('cofco_admin_levellabel')->where('cid','IN',function ($query) {
                        $query->table('cofco_admin_levellabel')->where('id', 1)->field('id');
                    })->field('id');
                })->field('id');
            })->column('id');
            $yuanliaotype_arr = $yuanliao_all_ids;
        }

        $query_yuanliao = LevellabelModel::where('id', 'IN', $yuanliaotype_arr)->select();
        $label_name=array();
        $label_name_info=[];
        $label_id=array();
        $label_cid=array();

        $label_info=[];
        foreach ($query_yuanliao as $keykk => $vvv) {
            $item = $vvv['id'];  #levellabel.id
            $result = Db::table('cofco_admin_content')
                ->where('art_id', 'IN',
                    function ($query) use ($item) {
                        $query->table('cofco_admin_article_label')->where('label_id', $item)->field('art_id'); #查询label_id($item)的所有字段的art_id
                    })
                ->field('count(art_id) count')
                ->select();
            array_push($label_name, $vvv['value']);
            array_push($label_id, $vvv['id']);
            array_push($label_cid, $vvv['cid']);
            foreach ($result as $k=>$v) $label_info[$vvv['value']]['count'] = $v['count'];
            $label_info[$vvv['value']]['id']=$item;
            $label_info[$vvv['value']]['cid']=$vvv['cid'];
            $label_info[$vvv['value']]['label']=$vvv['value'];
        }

        $label_name_info['label']=$label_name;
        $label_firstlevel_arr=array();
        $label_secondlevel_arr=array();
        #分出一级标签id和二级标签id（通过cid）
        for($i=0;$i<count($label_cid);$i++){
            if(in_array($label_cid[$i],$label_id)) array_push($label_secondlevel_arr, $label_id[$i]);
        }
        for($i=0;$i<count($label_id);$i++){
            if(in_array($label_id[$i],$label_secondlevel_arr)){}
            else
                array_push($label_firstlevel_arr,$label_id[$i]);
        }
        $label_firstlevel=[];
        $label_secondlevel=[];
        #分别获取内环和外环需要的数据
        #内环：显示所有一级标签
        #外环（两种情况）：1、一级标签下存在二级标签，外环只需要显示二级标签。2、一级标签下不存在二级标签，外环需显示该一级标签
        foreach($label_info as $key=> $vv){
            for($i=0;$i<count($label_firstlevel_arr);$i++){
                if($vv['id']==$label_firstlevel_arr[$i]) {
                    $label_firstlevel[$vv['label']]['name'] = $vv['label'];
                    $label_firstlevel[$vv['label']]['count']= $vv['count'];
                    $flag=0;
                    foreach($label_info as $keyk=> $v){
                        if($v['cid']==$vv['id']){
                            $flag=1;
                            $label_secondlevel[$v['label']]['name']=$v['label'];
                            $label_secondlevel[$v['label']]['count']=$v['count'];
                        }
                    }
                    if($flag==0){
                        $label_secondlevel[$vv['label']]['name']=$vv['label'];
                        $label_secondlevel[$vv['label']]['count']=$vv['count'];
                    }
                }
            }
        }

        $this->assign('user_input', $this->request->post());
        $this->assign('result', $label_info);
        $this->assign('display_statistic', '1');
        $this->assign('label_name', $label_name);
        $this->assign('label_first', $label_firstlevel);
        $this->assign('label_second', $label_secondlevel);
        return $this->fetch();

    }

    /*
     * 嵌套环形图——标签选择弹出窗口
     * 去掉了最上级标签前面的选择框
     */
    public function pie_levelpop($q = '')
    {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        $map = [];
        if ($q) {
            $map['value'] = ['like', '%' . $q . '%'];
        } else
            $map['status'] = 1;

        $menu_list = LevellabelModel::getAllChild(0, 0);
//        var_dump($menu_list[0]['childs']['1']);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        $this->assign('menu_list', $menu_list);
        $this->assign('display_statistic', '1');
        return $this->fetch();
    }
}
