<?php
namespace app\cofco\admin;
use app\admin\controller\Admin;
use app\cofco\model\AdminLabel as LabelModel;
use app\cofco\model\AdminTag as TagModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;
use app\cofco\model\AdminFinaly as FinalyModel;
use app\cofco\model\AdminId as IdModel;
use think\Exception;
use think\Db;

class Statistic extends Admin
{
    /*
     * 数据标注说明
     * */
    public function index()
    {
        $welcome_html = config('dataanalyse.dataanalyse_welcome_info');
        $this->assign('welcome_html',$welcome_html);
        return $this->afetch();
    }

    /**
     * 标签列表
     * @return string
     */
    public function count()
    {
        if(! $this->request->isPost()){

            $this->assign('dispaly_statistic','0');
            return $this->fetch();
        }

        $jibingtype_arr = explode("#", $this->request->post('jibingtype'));
        $yuanliaotype_arr = explode("#", $this->request->post('yuanliaotype'));

        $jibing_idstr = $this->request->post('jibingtype');
        if(empty($jibing_idstr)){
            # 疾病所有的ID
            $jibing_all_ids = Db::table('hisi_admin_levellabel')->where('cid','IN',function($query){
                $query->table('hisi_admin_levellabel')->where('id',3)->field('id');
            })->whereOr('cid','IN',function ($query){
                $query->table('hisi_admin_levellabel')->where('id',3)->whereOr('cid','IN',function($query){
                    $query->table('hisi_admin_levellabel')->where('id',3)->field('id');
                })->field('id');
            })->column('id');
            $jibingtype_arr = $jibing_all_ids;
        }

        $yuanliao_idstr = $this->request->post('yuanliaotype');
        if(empty($yuanliao_idstr)){
            $yuanliao_all_ids = Db::table('hisi_admin_levellabel')->where('cid','IN',function($query){
                $query->table('hisi_admin_levellabel')->where('id',4)->field('id');
            })->whereOr('cid','IN',function ($query){
                $query->table('hisi_admin_levellabel')->where('id',4)->whereOr('cid','IN',function($query){
                    $query->table('hisi_admin_levellabel')->where('id',4)->field('id');
                })->field('id');
            })->column('id');
            $yuanliaotype_arr = $yuanliao_all_ids;
        }

        # 实验类型标签的下方的所有ID
        $shiyan_all_ids = Db::table('hisi_admin_levellabel')->where('cid','IN',function($query){
            $query->table('hisi_admin_levellabel')->where('id',2)->field('id');
        })->whereOr('cid','IN',function ($query){
            $query->table('hisi_admin_levellabel')->where('id',2)->whereOr('cid','IN',function($query){
                $query->table('hisi_admin_levellabel')->where('id',2)->field('id');
            })->field('id');
        })->column('id');



        # 从实验类型总和与原料下的每个实验类型的角度进行统计
        $inner_statistic_info = []; # 柱状图统计信息
        $shiyan_names = LevellabelModel::where('id','IN', $shiyan_all_ids)->column('value');
        $level_info =  array();
        $shiyanfenzu = array();
        foreach ($shiyan_names as $v){
            $inner_statistic_info[$v] = [];
            $inner_statistic_info[$v]['inner_percent'] = [];
            $shiyanfenzu[$v]['number'] = array();
            $level_info[$v] = LevellabelModel::get(['value'=>$v])->toArray();
            $level_info[$v]['p_total_number'] = 0;
        }

        # 从原料角度进行统计
        $yuanliaonames = LevellabelModel::where('id','IN', $yuanliaotype_arr)->column('value');
        $yuanliao_statistic_info = [];
        foreach ($yuanliaonames as $v){
            $yuanliao_statistic_info[$v] = LevellabelModel::get(['value'=>$v])->toArray();
            $yuanliao_statistic_info[$v]['p_total_number'] = 0;
        }


        $query_yuanliao = LevellabelModel::where('id','IN', $yuanliaotype_arr)->select();
        foreach ($query_yuanliao as $keykk=>$vvv){
            $item = $vvv['id'];
            $yuanliao_name = $vvv['value'];
            #统计所有实验类型数目
            $result = Db::table('hisi_admin_id')
                ->alias('ai')
                ->join('hisi_admin_levellabel ll', 'ai.tid = ll.id')
                ->where('ai.pid',"IN",
                    function ($query) use ($item, $jibingtype_arr){
                        $query->table('hisi_admin_id')
                            ->where('pid','IN', function ($query) use ($item){ $query->table('hisi_admin_id')->where('tid', $item)->field('pid'); })
                            ->where('tid','IN',$jibingtype_arr)
                            ->field('pid');
                    })
                ->where('ai.tid','IN', $shiyan_all_ids)
                ->group('tid')
                ->field('ai.tid, ll.value, count(ai.pid) count')
                ->select();

            $yuanliao_p_number = 0;
            foreach ($shiyanfenzu as $name=>$arr){

                #  默认为0，因为result中不一定含有该实验的值
                $count = 0;
                foreach ($result as $k=>$v) {
                    if ($v['value'] == $name) {
                        $count = $v['count'];
                        break;
                    }
                }
                $level_info[$name]['p_total_number'] += $count;
//                $score = LevellabelModel::where('value',$name)->find()->toArray()['score'];
                array_push( $shiyanfenzu[$name]['number'],$count);
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
        foreach ($level_info as $name=>$value){
            $ss = $value['p_total_number'] * $value['score'];
            if($ss > $statistic_info['max_score']){
                $statistic_info['max_score'] = $ss;
                $statistic_info['max_name'] = $name;
            }
            $statistic_info['total_p'] += $value['p_total_number'];
            $statistic_info['total_score'] += $ss;
        }

        #处理表格百分比
        foreach ($level_info as $name=>$value){
            $level_info[$name]['percent'] = $statistic_info['total_p']==0?0: round(100.0 * $value['p_total_number']/$statistic_info['total_p'],2);
        }


        #处理柱状图百分比
        $sum_grout = [];
        for($i=0;$i<sizeof($yuanliaonames);$i++){
            $sum_t = 0;
            foreach ($shiyanfenzu as $name=>$value){
                $sum_t += $value['number'][$i];
            }
            $sum_grout[$i] = $sum_t;
        }
        foreach ($shiyanfenzu as $name=>$value){
            $inner_percent = [];
            $i = 0;
            foreach($value['number'] as $v){
                $p = $sum_grout[$i]==0?0:round(100.0*$v/$sum_grout[$i],2);
                array_push($inner_percent,$p);
                $i ++;
            }
            $shiyanfenzu[$name]['inner_percent'] = $inner_percent;
        }

        $this->assign('user_input',$this->request->post());
        $this->assign('shiyan_names',$shiyan_names);
        $this->assign('shiyanfenzu',$shiyanfenzu);
        $this->assign('yuanliao_statistic_info',$yuanliao_statistic_info);
        $this->assign('statistic_info',$statistic_info);
        $this->assign('level_info',$level_info);
        $this->assign('mingcheng',$yuanliaonames);
        $this->assign('dispaly_statistic','1');
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
        }
        else
            $map['status']=1;

        $menu_list = LevellabelModel::getAllChild(0, 0);
        //var_dump($menu_list[0]['childs']['1']);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        $this->assign('menu_list', $menu_list);

        $this->assign('dispaly_statistic','1');
        return $this->fetch();
    }
    /**
     * 新建爬虫页面
     * @return string
     */
    public function spider_add()
    {
        return $this->afetch('spider_form');
    }

    /**
     * 编辑爬虫页面
     * @return string
     */
    public function spider_edit()
    {
        return $this->afetch('spider_form');
    }

    /**
     * 爬虫状态查看页面，建议使用web_socket技术
     * @return string
     */
    public function spider_status(){

        return $this->afetch();
    }

    /**
     * 爬虫关键词列表页面
     * @return string
     */
    public function keywords_list(){

        return $this->afetch();
    }

    /**
     * 新建关键词词组
     * @return string
     */
    public function keywords_add(){

        return $this->afetch('keywords_form');
    }

    /**
     * 编辑关键词词组
     * @return string
     */
    public function keywords_edit(){

        return $this->afetch('keywords_form');
    }

    /**
     * 删除关键词词组
     * @return string
     */
    public function keywords_del(){

        return $this->afetch();
    }
}