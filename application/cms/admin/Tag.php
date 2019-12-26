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
use app\cms\model\CmsTag as TagModel;

/**
 * 标签控制器
 * @package app\cms\admin
 */
class Tag extends Admin
{
    protected $hisiModel = 'CmsTag';

    public function index()
    {
        if ($this->request->isAjax()) {

        	$limit 	= $this->request->param('limit/d', 20);
        	$page 	= $this->request->param('page/d', 1);
            $mid 	= $this->request->param('mid/d');
            $where  = [];

            if ($mid) {
                $where[] = ['mid', '=', $mid];
            }

            $data['data'] 	= TagModel::with('hasModel')
                                        ->order('search_count desc')
                                        ->where($where)
                                        ->limit($limit)
                                        ->page($page)
                                        ->select();
                                        
            $data['count']	= TagModel::count('id');
            $data['code'] 	= 0;

            return json($data);

        }

        return $this->fetch();
    }
}