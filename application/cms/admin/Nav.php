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
use app\cms\model\CmsNav as NavModel;

use hisi\Tree;

/**
 * 导航控制器
 * @package app\cms\admin
 */
class Nav extends Admin
{
    protected $hisiModel 	= 'CmsNav';
    protected $hisiValidate = 'CmsNav';

    protected function initialize()
    {
        parent::initialize();

        $action = $this->request->action();

        if (($action == 'add' || $action == 'edit') && !$this->request->isPost()) {

            // 获取所有分类
            $id         = $this->request->param('id/a');
            $pid        = $this->request->param('pid/d');
            $navs       = NavModel::order('sort asc')->column('id,pid,title');
            $tree       = new Tree(['name' => 'title']);
            $treeData   = $tree::ToTree($navs);

            $assign             = [];
            $assign['navSelect']= $tree::toOptions($treeData, $pid, $id);
            $assign['groups']   = NavModel::where('groups', '<>', '')->distinct(true)->field('groups')->select();

            $this->assign($assign);

        }

    }

    public function index()
    {
        if ($this->request->isAjax()) {

            $where      = $data = [];
            $pid        = $this->request->param('pid/d', 0);
            $groups     = $this->request->param('groups/s');

            if ($groups) {
                $where[] = ['groups', '=', $groups];
            }

            $where[] = ['pid', '=', $pid];

            $data['data']   = NavModel::order('groups asc,sort asc')->where($where)->select();
            $data['code']   = 0;
            
            return json($data);

        }
        
        return $this->fetch();
    }
}