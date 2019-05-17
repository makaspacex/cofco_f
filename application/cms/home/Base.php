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

namespace app\cms\home;
use app\common\controller\Common;
use app\cms\model\CmsContent as ContentModel;

class Base extends Common
{
    protected function initialize()
    {
        parent::initialize();
        $this->timedRelease();

    }

    /**
     * 定时发布
     * @date   2019-01-16
     * @access public
     * @author 橘子俊 364666827@qq.com
     */
    protected function timedRelease()
    {
    	ContentModel::where('status', 2)->where('timing', '<=', $_SERVER['REQUEST_TIME'])->setField('status', 1);
    }
}