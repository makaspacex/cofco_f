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
 * 表单字段验证器
 * @package app\cms\validate
 */
class CmsFormField extends Validate
{
    //定义验证规则
    protected $rule = [
        'fid|所属模型' => [
            'require', 
            'number',
        ],
        'title|字段标题' => [
            'require', 
            'length' => '1,20', 
            'unique' => 'cms_form_field,fid^title',
        ],
        'name|字段名称' => [
            'require', 
            'length' => '1,30', 
            'checkSystemField' => 'thinkphp',
            'regex' => '/^[A-Za-z\_]+$/',
            'unique' => 'cms_form_field,fid^name',
        ],
        'max_length|字段长度' => [
            'requireWith' => 'max_length',
            'number',
            'between' => '1,255',
        ],
    ];

    /**
     * 检查系统字段
     * @author 橘子俊 <364666827@qq.com>
     * @return stirng|array
     */
    protected function checkSystemField($value, $rule, $data)
    {
        $sys = ['id', 'user_id', 'fid', 'name', 'ip', 'user_agent', 'read_status', 'delete_time'];

        if (in_array($value, $sys)) {
            return '['.$value.']为系统字段';
        }

        return true;
    }
}
