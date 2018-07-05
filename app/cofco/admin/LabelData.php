<?php

namespace app\cofco\admin;

use app\cofco\model\AdminLabel as LabelModel;
use app\cofco\model\AdminTag as TagModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;
use app\cofco\model\AdminFinaly as FinalyModel;
use app\cofco\model\AdminId as IdModel;
use app\admin\controller\Admin;
use think\Exception;
use think\Db;

/**
 * Class Spider
 *
 * 该文件要实现人工输入功能如下：
 * 一、手动输入页面
 * 1、标题[必填]
 * 2、DOI[必填]
 * 3、摘要[必填]
 * 4、中文翻译[可选]
 * 5、标签选择[必填]
 * 二、半自动输入页面
 * 方式1：输入URL->爬取结果显示[可编辑，包含文献基本信息]，选择标签[必填]，中文翻译[可选]->入库
 * 方式2：输入关键词->结果显示，可选择：进入待审核数据库或进入黑名单或点击其中一篇按照方式1编辑入库
 *
 *
 *
 *
 *
 *
 * @package app\COFCO\admin
 */
class Labeldata extends Admin
{
    /*
     * 人工输入说明
     * */
    public function index()
    {
        $welcome_html = config('labeldata.label_welcome_info');
        $this->assign('welcome_html', $welcome_html);
        return $this->afetch();
    }

    public $tab_data = [];
    public $tab_data1 = [];

    protected function _initialize()
    {
        parent::_initialize();

        $tab_data['menu'] = [
            [
                'title' => '标签分组',
                'url' => 'cofco/labeldata/label_list',
            ],
            [
                'title' => '标签列表',
                'url' => 'cofco/labeldata/tag_list',
            ],
        ];
        $this->tab_data = $tab_data;
    }

//    public function levellabel()
//    {
//        $map = [];
//        $data_list = LevellabelModel::where($map)->paginate(10, false, ['query' => input('get.')]);
//        // 分页
//        $pages = $data_list->render();
//        $this->assign('data_list', $data_list);
//        $this->assign('pages', $pages);
//
//        //var_dump($data_list);
//        return $this->fetch();
//    }

    public function levellabel()
    {
        $menu_list = LevellabelModel::getAllChild(0, 0);
        $this->assign('menu_list', $menu_list);
        return $this->fetch();
    }

    public function levellabel_add($cid='')
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            unset($data['id']);
            if (!LevellabelModel::create($data)) {
                return $this->error('添加失败！');
            }
            return $this->success('添加成功。', 'levellabel');
        }
        $this->assign('levellabel_option', LevellabelModel::getOption());
        $row['cid']=$cid;
        $this->assign('data_info', $row);
        return $this->afetch('levellabel_form');
    }

    public function levellabel_edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (!LevellabelModel::update($data)) {
                return $this->error('修改失败！');
            }
            return $this->success('修改成功。', 'levellabel');
        }
        $row = LevellabelModel::where('id', $id)->find()->toArray();
        $this->assign('levellabel_option', LevellabelModel::getOption());
        $this->assign('data_info', $row);
        return $this->afetch('levellabel_form1');
    }

    public function levellabel_del()
    {
        $ids = input('param.ids/a');
        $model = new LevellabelModel;
        if (!$model->del($ids)) {
            return $this->error($model->getError());
        }
        return $this->success('删除成功');
    }

    public function levelpop($q = '')
    {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
//        $map = [];
//        if ($q) {
//            $map['value'] = ['like', '%' . $q . '%'];
//        }
//        else
//            $map['status']=1;

        $menu_list = LevellabelModel::getAllChild(0, 0);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        $this->assign('menu_list', $menu_list);
        return $this->fetch();
    }

    /**
     * 标签列表
     * @return string
     */
    public function label_list()
    {
        $data_list = LabelModel::paginate();

        // 分页
        $pages = $data_list->render();
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
        return $this->afetch();
    }

    public function label_add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证
            $result = $this->validate($data, 'AdminMember');
            if ($result !== true) {
                return $this->error($result);
            }
            unset($data['id']);
            if (!LabelModel::create($data)) {
                return $this->error('添加失败！');
            }
            cache('system_label', LabelModel::getAll());
            return $this->success('添加成功。', 'label_list');
        }
        return $this->afetch('label_form');
    }

    public function label_edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (!LabelModel::update($data)) {
                return $this->error('修改失败！');
            }
            // 更新缓存
            cache('system_label', LabelModel::getAll());
            return $this->success('修改成功。', 'label_list');
        }
        $row = LabelModel::where('id', $id)->find()->toArray();

        $this->assign('data_info', $row);
        return $this->afetch('label_form');
    }


    public function label_del()
    {
        $ids = input('param.ids/a');
        $model = new LabelModel;
        if (!$model->del($ids)) {
            return $this->error($model->getError());
        }
        return $this->success('删除成功');
    }

    public function tag_list()
    {
        $map = [];
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $data_list = TagModel::where($map)->paginate(10, false, ['query' => input('get.')]);
        // 分页
        $pages = $data_list->render();
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);

        //var_dump($data_list);
        return $this->fetch();
    }

    public function tag_add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证
            $result = $this->validate($data, 'AdminMember');
            if ($result !== true) {
                return $this->error($result);
            }
            unset($data['id']);
            if (!TagModel::create($data)) {
                return $this->error('添加失败！');
            }
            return $this->success('添加成功。', 'tag_list');
        }
        $this->assign('label_option', LabelModel::getOption());
        return $this->afetch('tag_form');
    }

    public function tag_edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (!TagModel::update($data)) {
                return $this->error('修改失败！');
            }
            // 更新缓存
            //cache('system_member_level', KwModel::getAll());
            return $this->success('修改成功。', 'tag_list');
        }
        $row = TagModel::where('id', $id)->find()->toArray();
        $this->assign('label_option', LabelModel::getOption());
        $this->assign('data_info', $row);
        return $this->afetch('tag_form');
    }
//
    public function tag_del()
    {
        $ids = input('param.ids/a');
        $map = [];
        $map['id'] = ['in', $ids];
        $res = TagModel::where($map)->delete();
        if ($res === false) {
            return $this->error('操作失败！');
        }
        return $this->success('操作成功！');
    }

    public function tag_pop($q = '')
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

        $data_list = TagModel::where($map)->paginate(10, false, ['query' => input('get.')]);
        // 分页
        $pages = $data_list->render();
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function pending_padd()
    {
        if ($this->request->isPost()) {
            $temp=1;
            $data = $this->request->post();
            $data['issue']=strtotime($data['issue']);

            $var=explode("#",$data['tag_id']);
            for($x=0;$x<count($var);$x++)
            {
                while ($temp>-1)
                {
                    $array = array("id"=>"","tid"=>"");
                    $row2 = LevellabelModel::where('id', $var[$x])->field('cid')->find()->toArray();
                    $array['id']=$data['id'];$array['tid']=$var[$x];
                    if (!(IdModel::where('id', $array['id'])->find()))
                    {
                        if (IdModel::create($array)) {
                            $temp=$row2['cid'];
                            $var[$x]=$temp;
                        }
                    }
                    if ($var[$x]==0)
                        break;
                }
            }

            if($data['status']==2) {
                unset($data['id']);
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                return $this->success('添加成功。');
            }
            if($data['status']==3) {
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                else
                {
                    unset($data['id']);
                    if (!FinalyModel::create($data)) {
                        return $this->error('添加失败！');
                    }
                    return $this->success('添加成功。');
                }
            }
        }
        return $this->afetch('pending_form1');
    }

    public function pending_add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['issue']=strtotime($data['issue']);
            $temp=1;
            $var=explode("#",$data['tag_id']);
            for($x=0;$x<count($var);$x++)
            {
                while ($temp>-1)
                {
                    $array = array("id"=>"","tid"=>"");
                    $row2 = LevellabelModel::where('id', $var[$x])->field('cid')->find()->toArray();
                    $array['id']=$data['id'];$array['tid']=$var[$x];
                    if (!(IdModel::where('id', $array['id'])->find()))
                    {
                        if (IdModel::create($array)) {
                            $temp=$row2['cid'];
                            $var[$x]=$temp;
                        }
                    }
                    if ($var[$x]==0)
                        break;
                }
            }
            if($data['status']==2) {
                unset($data['id']);
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                return $this->success('添加成功。', 'pending_list');
            }
            if($data['status']==3) {
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                else
                {
                    unset($data['id']);
                    if (!FinalyModel::create($data)) {
                        return $this->error('添加失败！');
                    }
                    return $this->success('添加成功。','pending_list');
                }
            }
        }
        return $this->afetch('pending_form');
    }
//    public function pending_list($q='')
//    {
//        $q = input('param.q/s');
//        $map = [];
//        if ($q) {
//            $map['title'] = ['like', '%' . $q . '%'];
//
//        }
//        if($q=='')
//            $data_list = PendingModel::where('status',2)->paginate();
//        else {
//            $data_list = PendingModel::where($map)->paginate(10, false, ['query' => input('get.')]);
//
//        }
//
//        // 分页
//        $pages = $data_list->render();
//        $this->assign('data_list', $data_list);
//        $this->assign('pages', $pages);
////        var_dump($data_list);
//        return $this->fetch();
//    }

    public function pending_list($q='')
    {
        //$q = input('param.q/s');
        $var=explode("#",$q);
        $map = [];
        if ($q) {
            //$map['title'] = ['like', '%' . $q . '%'];
            $map = str_replace('#', ',', $q);
            $count=count($var);
            //$map['tid'] = ['in', $var];
        }
        if($q=='')
        {$data_list = PendingModel::where('status',2)->paginate();
            $pages = $data_list->render();
            $this->assign('data_list', $data_list);
            $this->assign('pages', $pages);
        }
        else {
            //$data = IdModel::where($map)->field('pid,tid')->paginate(10, false, ['query' => input('get.')]);
            //$data=IdModel::distinct('pid')->where($map)->field('pid')->paginate(10, false, ['query' => input('get.')]);
            //$tem=IdModel::distinct('pid')->where($map)->field('pid')->group('pid')->paginate(10, false);
            //$map1['id']=['in',$tem];
            //$data_list = PendingModel::where('status',2)->paginate();
            //$data_list=PendingModel::join('LEFT JOIN work ON hisi_admin_id.pid = spiderapp_content.id')->where($tem)->paginate(10, false);
            //$data_list=PendingModel::
            //$data_list=$data;
            //var_dump($data_list);
            $data_list = Db::query('SELECT * FROM spiderapp_content LEFT JOIN hisi_admin_id ON hisi_admin_id.pid = spiderapp_content.id WHERE hisi_admin_id.tid IN ('.$map.') GROUP BY hisi_admin_id.pid HAVING COUNT(DISTINCT spiderapp_content.id,hisi_admin_id.tid) = '.$count.' LIMIT 15');

        }
        //echo Db::table('spiderapp_content')->getLastSql();
        // 分页
        //$pages = $data_list->render();
        $this->assign('data_list', $data_list);
        //$this->assign('pages', $pages);
//        var_dump($data_list);
        return $this->fetch();
    }

    public function pending_del()
    {
        $ids = input('param.ids/a');
        $map = [];
        $map['id'] = ['in', $ids];
        $res = PendingModel::where($map)->delete();
        if ($res === false) {
            return $this->error('操作失败！');
        }
        return $this->success('操作成功！');
    }

    public function pending_edit($id = 0)
    {
        if ($this->request->isPost()) {
            $map = [];
            $map['pid'] = $id;
            IdModel::where($map)->delete();
            $data = $this->request->post();
            $data['issue']=strtotime($data['issue']);
            if($data['status']==2) {
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
                else {
                    $var1=explode("#",$data['tag_id']);
                    for ($x=0;$x<count($var1);$x++) {
                        $temp = $var1[$x];
                        while ($temp != 0) {
                            $array = array("pid" => "", "tid" => "");
                            $row2 = LevellabelModel::where('id', $temp)->field('cid')->find()->toArray();
                            $array['pid'] = $data['id'];
                            $array['tid'] = $temp;
                            $temp = $row2['cid'];
                            if (!(IdModel::where('pid', $array['pid'])->where('tid',$array['tid'])->find())) {
                                IdModel::create($array);
                            }
                        }
                    }
                            return $this->success('修改成功。', 'pending_list');


                }
            }
            if($data['status']==3) {
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
                else
                    {
                        $var1=explode("#",$data['tag_id']);
                        for ($x=0;$x<count($var1);$x++) {
                            $temp = $var1[$x];
                            while ($temp != 0) {
                                $array = array("pid" => "", "tid" => "");
                                $row2 = LevellabelModel::where('id', $temp)->field('cid')->find()->toArray();
                                $array['pid'] = $data['id'];
                                $array['tid'] = $temp;
                                $temp = $row2['cid'];
                                if (!(IdModel::where('pid', $array['pid'])->where('tid',$array['tid'])->find())) {

                                    IdModel::create($array);
                                }
                            }
                        }
                       unset($data['id']);
                       if (!FinalyModel::create($data)) {
                           return $this->error('添加失败！');
                       }
                       else {
                           return $this->success('添加成功。', 'pending_list');
                       }
                    }
            }

        }
        $row1 = PendingModel::where('id', $id)->find()->toArray();
        $row1 = str_replace('?', ' ', $row1);
        $tag_id = $row1['tag_id'];
        if ($tag_id != null) {
            $var=explode("#",$tag_id);
            $array = array("value"=>"");
            for($x=0;$x<count($var);$x++)
            {
                $row2 = LevellabelModel::where('id', $var[$x])->field('value')->find()->toArray();
                //$row2 = str_replace(PHP_EOL, '#', $row2);
                if($x==0)
                {
                    $array['value']=$row2['value'];
                }
                else
                {
                    $array['value']=$array['value'].'#'.$row2['value'];
                }
            }
        }
        else
            $array = array();
        //var_dump($array);
        $row = array_merge($row1, $array);
        if(mb_strlen($row['issue'],'utf8')>2)
        $row['issue']=date("Y-m-d", $row['issue']);
        else
            $row['issue']=null;
        //var_dump($row);
        $row['author'] = PendingModel::strFilter($row['author']);
        $row['keyword'] = PendingModel::strFilter($row['keyword']);
        $row['country'] = PendingModel::strFilter($row['country']);
        $row['institue'] = PendingModel::strFilter($row['institue']);
        $this->assign('data_info', $row);

        return $this->afetch('pending_dform');
    }

    public function pop($id)
    {
        // $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        //$ids   = input('param.ids/a');
        $map = [];
        $map['id'] = ['in', $id];
        $data_list = PendingModel::where($map)->paginate(10, false);
        // 分页
        // var_dump($data_list);
        $pages = $data_list->render();
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function crawurl()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //$t = strtotime('2015-6-16 12:04:05');
            //$data['issue']=strtotime($data['issue']);

            if(count($data)>2){
                $data['issue']=strtotime($data['issue']);
                unset($data['id']);

                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                return $this->success('添加成功。');
                return $this->afetch('pending_pform');
            }

            //$url = "http://10.2.145.166:8000/spider/crawurl";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,config('spider.spider_api_crawurl'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLINFO_CONNECT_TIME, 3);
            curl_setopt($ch, CURLINFO_TOTAL_TIME, 3);
            curl_setopt($ch, CURLINFO_NAMELOOKUP_TIME, 3);
            try{
                 $output = curl_exec($ch);
                 $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                 //return $this->error($http);
                if ($http != 200) {
                    curl_close($ch);
                    throw  new Exception('链接失败');
                }
                $data_list = json_decode($output, true);
                $row = $data_list['data'];
                $row['issue']=date("Y-m-d H:i:s", $row['issue']);
                if ($data_list['status'] == 0)
                   // return $this->error($data_list['msg']);
                    throw  new Exception($data_list['msg']);
                $this->assign('data_info', $row);
                return $this->afetch('pending_pform');
            }catch (Exception $exception){
                $msg=$exception->getMessage();
                echo "<script>alert('$msg')</script>";
                //return $this->afetch('pending_fform');
            }

        }
        return $this->afetch('pending_fform');
    }
//    public function crawurl(){
//        $info=array();
//        if ($this->request->isPost()) {
//                $info= array("title"=>"XC90");
//        }
//        $this->crawurl1($info);
//        return $this->afetch('pending_fform');
//    }
//    public function crawurl1()
//    {
//        $info=$this->crawurl();
//        if ($this->request->isPost()) {
//            $data = $this->request->post();
//            if (!PendingModel::update($data)) {
//                return $this->error('修改失败！');
//            }
//            // 更新缓存
//            //cache('system_member_level', KwModel::getAll());
//            return $this->success('修改成功。','pending_list');
//        }
//        $this->assign('data_info', $info);
//        return $this->afetch('pending_fform');
//    }
//$ids   = input('param.ids/a');
//$map = [];
//$map['id'] = ['in', $ids];
//$res = PendingModel::where($map)->delete();
//    public function pending_list($q='')
//    {
//        $q = input('param.q/s');
//        $map = [];
//        if ($q) {
//            $map['title'] = ['like', '%' . $q . '%'];
//        }
//        if($q=='')
//            $data_list = PendingModel::where('status',2)->paginate();
//        else
//            $data_list = PendingModel::where($map)->paginate(10, false, ['query' => input('get.')]);
//
//        // 分页
//        $pages = $data_list->render();
//        $this->assign('data_list', $data_list);
//        $this->assign('pages', $pages);
////        var_dump($data_list);
//        return $this->fetch();
//    }
    public function finaly_list($q='')
    {
//        $var=explode("#",$q);
//        $map['tid'] = ['in', $var];
        $data_list = FinalyModel::paginate();
        $pages = $data_list->render();
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
//        var_dump($data_list);
        return $this->fetch();
    }

    public function finaly_edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (!FinalyModel::update($data)) {
                return $this->error('修改失败！');
            }
            // 更新缓存
            //cache('system_member_level', KwModel::getAll());
            return $this->success('修改成功。','finaly_list');
        }
        $row = FinalyModel::where('id', $id)->find()->toArray();
        $row = str_replace('?', ' ', $row);
        $row = str_replace(PHP_EOL, '#', $row);
        if(mb_strlen($row['issue'],'utf8')>2)
            $row['issue']=date("Y-m-d", $row['issue']);
        else
            $row['issue']=null;
        $this->assign('data_info', $row);
        return $this->afetch('finaly_form');
    }

    public function finaly_url($id = 0)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt ($ch, CURLOPT_URL, $id);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        echo $file_contents;
    }
}