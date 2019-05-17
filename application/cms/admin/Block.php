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
use app\cms\model\CmsBlock as BlockModel;

/**
 * 碎片控制器
 * @package app\cms\admin
 */
class Block extends Admin
{
    protected $hisiModel    = 'CmsBlock';//模型名称[通用添加、修改专用]
    protected $hisiValidate = 'CmsBlock';

    public function index()
    {
        if ($this->request->isAjax()) {

            $where  = [];
            $page   = $this->request->param('page/d', 1);
            $limit  = $this->request->param('limit/d', 20);

            $data['data'] 	= BlockModel::where($where)->page($page)->limit($limit)->select();
            $data['count'] 	= BlockModel::where($where)->count('id');
            $data['code'] 	= 0;

            return json($data);

        }

        return $this->fetch();
    }
}