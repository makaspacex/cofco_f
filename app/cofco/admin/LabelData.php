<?php

namespace app\cofco\admin;

use app\cofco\model\AdminLabel as LabelModel;
use app\cofco\model\AdminTag as TagModel;
use app\cofco\model\AdminPending as PendingModel;
use app\cofco\model\AdminFinaly as FinalyModel;
use app\admin\controller\Admin;
use think\Exception;

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
class LabelData extends Admin
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
            $map['name'] = ['like', '%' . $q . '%'];
        }

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
            $data = $this->request->post();
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

    public function pending_add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
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

    public function pending_list($temp=2)
    {
        $data_list = PendingModel::where('status',$temp)->paginate();

        // 分页
        $pages = $data_list->render();
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
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
            
            $data = $this->request->post();
            if($data['status']==2) {
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
                return $this->success('修改成功。', 'pending_list');
            }
            if($data['status']==3) {
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
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
        $row1 = PendingModel::where('id', $id)->find()->toArray();
        $tag_id = $row1['tag_id'];
        if ($tag_id != null)
            $row2 = TagModel::where('id', $tag_id)->field('name')->find()->toArray();
        else
            $row2 = array();
        //var_dump($row2);
        $row = array_merge($row1, $row2);
        //var_dump($row);
        $row['author'] = PendingModel::strFilter($row['author']);
        $row['keyword'] = PendingModel::strFilter($row['keyword']);
        $row['country'] = PendingModel::strFilter($row['country']);
        $row['institue'] = PendingModel::strFilter($row['institue']);
        $this->assign('data_info', $row);
        // $this->assign('data_info1', $row1);
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
            if(count($data)>2){
                unset($data['id']);
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                return $this->success('添加成功。');
                return $this->afetch('pending_pform');
            }

            $url = "http://10.2.145.166:8000/spider/crawurl";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
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
    public function finaly_list()
    {
        $data_list = FinalyModel::paginate();

        // 分页
        $pages = $data_list->render();
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
//        var_dump($data_list);
        return $this->fetch();
    }
}