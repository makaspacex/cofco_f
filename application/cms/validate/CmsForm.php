<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
namespace app\cms\validate;

use think\Validate;

/**
 * 表单验证器
 * @package app\cms\validate
 */
class CmsForm extends Validate
{
    //定义验证规则
    protected $rule = [
        'title|模型名称' => [
            'require', 
            'length' => '1,20', 
            'unique' => 'cms_form',
        ],
        'table_name|表名称' => [
            'require', 
            'length' => '1,30', 
            'unique' => 'cms_form',
            'regex' => '/^[a-z\_]+$/',
        ],
    ];
}