<?php

namespace app\cofco\admin;

use app\cofco\model\AdminLabel as LabelModel;
use app\cofco\model\AdminTag as TagModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;
use app\cofco\model\AdminSpiderTask as SpiderTaskModel;
use app\cofco\model\AdminKw as KwModel;

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
class Labeldata extends AdminBase
{
    /*
     * 人工输入说明
     * */

    public function index()
    {
        $welcome_html = config('labeldata.label_welcome_info');
        $this->assign('welcome_html', $welcome_html);
        return $this->fetch();
    }

    public $tab_data = [];
    public $tab_data1 = [];


    public function levellabel()
    {
        $menu_list = LevellabelModel::getAllC(0, 0);
        $this->assign('menu_list', $menu_list);
        return $this->fetch();
    }


    public function levellabel_add($cid = '')
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
        $row['cid'] = $cid;
        $this->assign('data_info', $row);
        return $this->fetch('levellabel_form');
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
        return $this->fetch('levellabel_form1');
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

//        $callback = input('param.callback/s');
//
//        if (!$callback) {
//            echo '<br><br>callback为必传参数！';
//            exit;
//        }
        $menu_list = LevellabelModel::select();
//        $this->assign('callback', $callback);
//        return json_encode($menu_list);
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
        return $this->fetch();
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
        return $this->fetch('label_form');
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
        return $this->fetch('label_form');
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
        return $this->fetch('tag_form');
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
        return $this->fetch('tag_form');
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
        } else
            $map['status'] = 1;

        $data_list = TagModel::where($map)->paginate(10, false, ['query' => input('get.')]);
        // 分页
        $pages = $data_list->render();
        $this->assign('data_list', $data_list);
        $this->assign('pages', $pages);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        return $this->fetch();
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


    public function keywords_pop($q = '')
    {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        $map = [];
        if ($q) {
            $map['keywords'] = ['like', '%' . $q . '%'];
        } else
            $map['status'] = 1;
        $data_list = KwModel::where($map)->paginate(10, false, ['query' => input('get.')]);
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