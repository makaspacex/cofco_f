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
 * 表单控制器
 * @package app\cms\admin
 */
class Form extends Admin
{
    protected $hisiModel    = 'CmsForm';
    protected $hisiValidate = 'CmsForm';

    /**
     * 表单管理
     * @date   2019-01-09
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAjax()) {

            $data['data'] = FormModel::select();
            $data['code'] = 0;
            return json($data);

        }

        return $this->fetch();
    }

    /**
     * 表单代码显示
     * @date   2019-01-10
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int    $fid 表单ID
     * @return mixed
     */
    public function code($fid = 0)
    {

        $assign = [];
        $assign['form'] = FormModel::where('id', $fid)->find();

        $this->assign($assign);

        return $this->fetch();
    }
}
