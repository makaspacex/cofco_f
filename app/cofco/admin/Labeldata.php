<?php

namespace app\cofco\admin;

use app\cofco\model\AdminLabel as LabelModel;
use app\cofco\model\AdminTag as TagModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;
use app\cofco\model\AdminFinaly as FinalyModel;
use app\cofco\model\AdminId as IdModel;
use app\admin\controller\Admin;
use app\cofco\model\AdminSpiderTask as SpiderTaskModel;
use app\cofco\model\AdminKw as KwModel;
use app\admin\model\AdminUserlog as LogModel;
use think\Exception;
use think\Db;
use app\cofco\common\util\OperateSql as OperateSql;

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
                'title' => '辅助输入',
                'url' => 'cofco/labeldata/crawurl',
            ],
            [
                'title' => '人工输入',
                'url' => 'cofco/labeldata/pending_padd',
            ],
            [
                'title' => '爬虫任务',
                'url' => 'cofco/labeldata/task_list1',
            ],
        ];
        $this->tab_data = $tab_data;
    }



    public function levellabel()
    {
        $menu_list = LevellabelModel::getAllC(0, 0);
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

    public function levelpop()
    {

        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }

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
            $data['issue']=date("Y-m", $data['issue']);
            $data['creater'] = $_SESSION['hisiphp_']['admin_user']['username'];
            if($data['status']==2) {
                unset($data['id']);
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                $sqlmap = [];
                $sqlmap['uID'] = $_SESSION['hisiphp_']['admin_user']['uid']; 
                $sqlmap['type']=1;
                $sqlmap['ctime'] = time();
                $sqlmap['year'] = date('Y');
                $sqlmap['month'] = date('m');
                $sqlmap['day'] = date('d');
                LogModel::create($sqlmap);
                return $this->success('添加成功。');
            }
            if($data['status']==3) {
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                else
                {
//                    unset($data['id']);
//                    if (!FinalyModel::create($data)) {
//                        return $this->error('添加失败！');
//                    }
                    return $this->success('添加成功。');
                }
            }
        }

        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        return $this->afetch('pending_form1');
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
    ini_set('max_execution_time', '60');
    $msg='';
    if ($this->request->isPost()) {
        $data = $this->request->post();
        if (count($data) > 4) {
            $data['creater'] = $_SESSION['hisiphp_']['admin_user']['nick'];
            unset($data['id']);
            if (!PendingModel::create($data)) {
                return $this->error('添加失败！');
            }

            // 添加日志
            $sqlmap = [];
            $sqlmap['uID'] = $_SESSION['hisiphp_']['admin_user']['uid']; 
            $sqlmap['tID'] = 0; 
            $sqlmap['type']=1;
            $sqlmap['ctime'] = time();
            $sqlmap['year'] = date('Y');
            $sqlmap['month'] = date('m');
            $sqlmap['day'] = date('d');
            LogModel::insert($sqlmap);

            return $this->success('添加成功。');
            return $this->afetch('pending_pform');
        }

        $ch = curl_init();
        if ($data['doi']!=null)
            {$data['doi']='/'.$data['doi'];}//把doi处理成爬虫接受的字符
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
            throw  new Exception('链接爬虫失败');
        }
        $data_list = json_decode($output, true);
                //var_dump($data_list);
        if ($data_list['status'] == 0) {
                    //return $this->error($data_list['msg']);
            curl_close($ch);
            $msg=$data_list['msg'];
            throw  new Exception($msg);
//                    $msg=$data_list['msg'];
//                    $this->assign('msg', $msg);
//                    return $this->afetch('pending_fform');
        }
                //var_dump($data_list);
        $row = $data_list['data'];
                #$AAA=isset($row['issue']);
               // var_dump($row);
//                if (strlen((string)(int)$row['issue'])>2)
//                {$row['issue']=date("Y-m", (int)$row['issue']);}
        $this->assign('data_info', $row);
        return $this->afetch('pending_pform');
    }catch (Exception $exception){
        $msg=$exception->getMessage();
                //echo "<script>alert('$msg')</script>";
        $this->assign('msg', $msg);
                //return $this->afetch('pending_fform');
    }

}
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->assign('msg', $msg);
        return $this->afetch('pending_fform');
}





    public function finaly_url($id=0)
    {
        $row = PendingModel::where('id', $id)->find()->toArray();
//        return $this->error($row['url']);
        if ($row['source']=='pm'){
            header("location:https://www.ncbi.nlm.nih.gov/pubmed/".$row['pmid']);
        }
        else
            header("location:https://www.sciencedirect.com/science/article/pii/".$row['pmid']);
        //header("location:".$row['url']);
    }
    public function task_list1()
    {
        try {
            $cu = curl_init();
            curl_setopt($cu, CURLOPT_URL, config('spider.spider_api_all'));
            //echo config('spider.spider_api_all');
            curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($cu, CURLOPT_CONNECTTIMEOUT_MS, 300);
            curl_setopt($cu, CURLOPT_TIMEOUT, 3);
            $ret = curl_exec($cu);
            //var_dump(json_decode($ret,true));
            $http = curl_getinfo($cu, CURLINFO_HTTP_CODE);
            if ($http != 200) {
                throw  new Exception('链接爬虫失败');
            }
            curl_close($cu);
            $row = json_decode($ret,true);
            //var_dump($row);
            $data_list=$row['data'];
            $msg=$row['msg'];
            $this->assign('msg', $msg);
            //var_dump($data_list);
        }catch (Exception $exception){
            $data_list = array();
            $msg=$exception->getMessage();
            //echo "<script>alert('$msg')</script>";
            $this->assign('msg', $msg);

            //var_dump($data_list) ;
        }
//        if(!isset($data_list['create_time']))
//        {
//            $ret = array('create_time');
//            $row = array_fill_keys($ret,0);
//            $data_list = array_merge($data_list, $row);
//        }
        //var_dump($data_list);
//          if($data_list==null)
//              $this->success($msg);
//        if(isset($data_list['sstr']))
//        {
//            $data_list['sstr'] = str_replace('`', '', $data_list['sstr']);
//        }
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->assign('data_list', $data_list);
        return $this->fetch();
    }
    public function task_add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $row=$data;
            //$row=$data;
            //var_dump($row);
            //$url = "http://39.108.188.10:9001/spider/add";
            //$url = "http://10.2.148.107:8000/spider/add";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,config('spider.spider_api_add'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
            if($output = curl_exec($ch)){
                curl_close($ch);
                $data_list = json_decode($output,true);
                if($data_list['status']==0)
                    return $this->error($data_list['msg']);
                else
                    return $this->success('添加成功！','task_list1');
            }
            return $this->error('添加失败');
        }
        $this->assign('spider_option', SpiderTaskModel::getOption());
        return $this->afetch('task_form');
    }
    public function task_stop($id=0)
    {
        if($id==0)
            { return $this->error('此爬虫未运行，禁止操作');}
        else
        {
            $ret=array('pid');
            $row=array_fill_keys($ret,$id);
            //$url = "http://http://10.2.175.30:9001/spider/stop";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, config('spider.spider_api_stop'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
            if($output = curl_exec($ch)){
                curl_close($ch);
                $data_list = json_decode($output,true);
                if($data_list['status']==0)
                    return $this->error($data_list['msg']);
                else
                    return $this->success('停止成功','task_list1');
            }
            return $this->error('停止失败');
        }
    }
    public function task_pause($id=0)
    {
        if($id==0)
            { return $this->error('此爬虫未运行，禁止操作');}
        else {
            $ret = array('pid');
            $row = array_fill_keys($ret, $id);
            //$url = "http://10.2.145.166:8000/spider/pause";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, config('spider.spider_api_pause'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
            if ($output = curl_exec($ch)) {
                curl_close($ch);
                $data_list = json_decode($output, true);
                if ($data_list['status'] == 0)
                    return $this->error($data_list['msg']);
                else
                    return $this->success('暂停成功');
            }
            return $this->error('暂停失败');
        }
    }

    public function task_continue($id=0)
    {
        if($id==0)
            { return $this->error('此爬虫未运行，禁止操作');}
        else
        {
            $ret = array('pid');
            $row = array_fill_keys($ret, $id);
            //$url = "http://10.2.145.166:8000/spider/continue";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, config('spider.spider_api_continue'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
            if ($output = curl_exec($ch)) {
                curl_close($ch);
                $data_list = json_decode($output, true);
                if ($data_list['status'] == 0)
                    return $this->error($data_list['msg']);
                else
                    return $this->success('继续成功');
            }
            return $this->error('继续失败');
        }
    }

    public function task_remove($id='')
    {
        $ret = array('sstr');
        $row = array_fill_keys($ret, $id);
        //$url = "http://10.2.145.166:8000/spider/remove";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('spider.spider_api_remove'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
        if ($output = curl_exec($ch)) {
            curl_close($ch);
            $data_list = json_decode($output, true);
            if ($data_list['status'] == 0)
                return $this->error($data_list['msg']);
            else
                return $this->success('删除成功');
        }
        return $this->error('删除失败');

    }

    public function task_startforce($id='')
    {
        $ret = array('sstr');
        $row = array_fill_keys($ret, $id);
        //return $this->error($id);
        //$url = "http://10.2.145.166:8000/spider/startforce";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('spider.spider_api_startforce'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
        if ($output = curl_exec($ch)) {
            curl_close($ch);
            $data_list = json_decode($output, true);
            if ($data_list['status'] == 0)
                return $this->error($data_list['msg']);
            else
                return $this->success('重启成功');
        }
        return $this->error('重启失败');

    }
    public function keywords_pop($q = '') {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        $map = [];
        if ($q) {
            $map['keywords'] = ['like', '%'.$q.'%'];
        }
        else
            $map['status']=1;
        $data_list = KwModel::where($map)->paginate(10, false,['query' => input('get.')]);
        // 分页
        //var_dump($data_list);
        $pages = $data_list->render();
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        return $this->fetch();
    }
}