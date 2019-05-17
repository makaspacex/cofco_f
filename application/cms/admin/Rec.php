<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------

namespace app\cms\admin;

use app\system\admin\Admin;
use app\cms\model\CmsRec as RecModel;
use app\cms\model\CmsModel as ModelModel;

use hisi\Tree;

/**
 * 推荐控制器
 * @package app\cms\admin
 */
class Rec extends Admin
{
    protected $hisiModel = 'CmsRec';

    protected function initialize()
    {
        parent::initialize();

        $action = $this->request->action();

        if (($action == 'add' || $action == 'edit') && !$this->request->isPost()) {

            // 获取推荐位
            $id         = $this->request->param('id/a');
            $pid        = $this->request->param('pid/d');
            
            $posData    = RecModel::order('sort asc')
            				->where('content_id', 0)
            				->where('type', 1)
            				->column('id,pid,title as name');
                            
            $treeData   = Tree::ToTree($posData);

            $assign                 = [];
            $assign['select']       = Tree::toOptions($treeData, $pid, $id);
            $assign['modelSelect']  = ModelModel::where('status',1)->order('sort asc')->column('id,title');
            $assign['hisiTabType']  = 1;
            
            $this->assign($assign);

        }

    }

    public function index()
    {
        if ($this->request->isAjax()) {

            $where      = $data = [];
            $pid        = $this->request->param('pid/d', 0);

            $where[] = ['pid', '=', $pid];

            $data['data']   = RecModel::order('sort asc')->where($where)->select();
            $data['code']   = 0;

            return json($data);

        }

        return $this->fetch();
    }
}