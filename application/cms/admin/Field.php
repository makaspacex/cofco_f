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
use app\cms\model\CmsField as FieldModel;
use app\cms\model\CmsModel as ModelModel;

/**
 * 模型字段控制器
 * @package app\cms\admin
 */
class Field extends Admin
{
    protected $hisiModel    = 'CmsField';
    protected $hisiValidate = 'CmsField';

    public function index($mid = 0)
    {

        if ($this->request->isAjax()) {
            $data['data'] = FieldModel::with('hasModel')->where('mid', $mid)->order('sort asc')->select();
            $data['code'] = 0;
            return json($data);
        }

        $modelInfo = ModelModel::where('id', $mid)->find();

        $this->assign(['modelInfo' => $modelInfo]);
        return $this->fetch();
    }
}