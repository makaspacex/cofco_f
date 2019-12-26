<?php

namespace app\cofco\admin;

use app\cofco\model\AdminLevellabel as LevellabelModel;


class Labeldata extends AdminBase
{

    public function index()
    {
        $welcome_html = config('labeldata.label_welcome_info');
        $this->assign('welcome_html', $welcome_html);
        return $this->fetch();
    }

    public $tab_data = [];


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

        return $this->fetch('label_form');
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

    /** 设置status
     * @return mixed|void
     */
    public function status()
    {

            $id = input('param.ids/s');
            $status = input('param.val/s');
            $map = [];
            $map['id'] = $id;
            $map['status'] = $status;
            $res = LevellabelModel::update($map);
            if($res){
                return $this->success("修改成功");
            }
            return $this->error("修改失败");

    }

    /**
     * 设置score
     */
    public function score()
    {
        if($this->request->isPost()){
            $id = input('param.ids/s');
            $score = input('param.val/s');
            $map = [];
            $map['id'] = $id;
            $map['score'] = $score;
            $res = LevellabelModel::update($map);
            if($res){
                return $this->success("修改成功");
            }
            return $this->error("修改失败");
        }
        return $this->error("请求错误");
    }
}