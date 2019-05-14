<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
namespace app\cofco\admin;

use app\admin\controller\Admin;

/**
 * 后台公共控制器
 * @package app\admin\controller
 */
class AdminBase extends Admin
{
    /**
     * 初始化方法
     */
    protected function _initialize()
    {
        parent::_initialize();
        define('MODULENAME', 'COFCO');
        define('NULL_STR', 'NULLSTRING!@#!');
        $this->assign('article_api_url','/cofco/article');
    }

}
