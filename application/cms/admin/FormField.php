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
use app\cms\model\CmsForm as FormModel;
use app\cms\model\CmsFormField as FieldModel;

/**
 * 表单字段控制器
 * @package app\cms\admin
 */
class FormField extends Admin
{
    protected $hisiModel    = 'CmsFormField';
    protected $hisiValidate = 'CmsFormField';

    /**
     * 表单字段管理
     * @date   2019-01-09
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $fid = $this->request->param('fid/d', 0);

            $data['data'] = FieldModel::where('fid', $fid)->order('sort asc')->select();
            $data['code'] = 0;
            return json($data);

        }

        return $this->fetch();
    }
}