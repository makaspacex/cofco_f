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
use app\cms\model\CmsLink as LinkModel;

/**
 * 友情链接控制器
 * @package app\cms\admin
 */
class Link extends Admin
{
    protected $hisiModel    = 'CmsLink';
    protected $hisiValidate = 'CmsLink';

    protected function initialize()
    {
        parent::initialize();
        
        $action = $this->request->action();
        
        if ( ($action == 'add' || $action == 'edit') && !$this->request->isPost() ) {
            
            $groups = LinkModel::where('groups', '<>', '')->distinct(true)->field('groups')->select();
            $this->assign('groups', $groups);

        }

    }

    public function index()
    {
        if ($this->request->isAjax()) {

            $data['data'] 	= LinkModel::order('groups asc,sort asc')->select();
            $data['code'] 	= 0;

            return json($data);

        }

        return $this->fetch();
    }
}