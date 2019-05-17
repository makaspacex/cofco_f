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
use app\cms\model\CmsType as TypeModel;
use app\cms\model\CmsAttributeItem as ItemModel;
use app\cms\model\CmsAttributeValue as ValueModel;

/**
 * 扩展类型控制器
 * @package app\cms\admin
 */
class Type extends Admin
{
    protected $hisiModel = 'CmsType';

    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();

        $action = $this->request->action();

        $hisiTabData['menu'] = [
            [
                'title' => '基本信息',
            ],
            [
                'title' => '扩展属性',
            ],
            [
                'title' => '详细参数',
            ],
        ];

        if (($action == 'add' || $action == 'edit') && !$this->request->isPost()) {

            $assign                 = [];
            $assign['hisiTabType']  = 2;
            $assign['hisiTabData']  = $hisiTabData;

        	$this->assign($assign);
    	}
    }

    public function index()
    {
        if ($this->request->isAjax()) {

            $data           = [];
            $data['data']   = TypeModel::with('hasAttrItems')->select();
            $data['code']   = 0;
            
            return json($data);

        }

        return $this->fetch();
    }
}