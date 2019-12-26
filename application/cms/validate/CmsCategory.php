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
 * 栏目分类验证器
 * @package app\cms\validate
 */
class CmsCategory extends Validate
{
    //定义验证规则
    protected $rule = [
        'name|栏目名称' => 'require|length:1,200|unique:cms_category',
        'pid|所属栏目' => 'require|number|checkPid:thinkphp',
        'url|栏目URL' => 'require|length:1,200|checkUrl:thinkphp|unique:cms_category',
        // 'poly_template|聚合模板' => 'requireIf:content_limit,1',
        // 'list_template|列表模板' => 'requireIf:content_limit,2',
        // 'show_template|详情模板' => 'requireIf:content_limit,2',
    ];

    //定义验证场景
    protected $scene = [
    	'edit' => [
    		'name',
            'pid',
    		'url',
            'poly_template',
            // 'list_template',
            // 'show_template',
    	],
    ];

    /**
     * 检查URL
     * @author 橘子俊 <364666827@qq.com>
     * @return stirng|array
     */
    protected function checkUrl($value, $rule, $data)
    {
        $arr = ['api', 'base', 'error', 'index', 'search', 'tag'];
        if (in_array(strtolower($value), $arr)) {
            return '禁止使用'.$value.'作为栏目URL';
        }

        return true;
    }

    /**
     * 检查PID
     * @author 橘子俊 <364666827@qq.com>
     * @return stirng|array
     */
    protected function checkPid($value, $rule, $data)
    {
        if (empty($data['id'])) {
            return true;
        }

        if ($data['pid'] == $data['id']) {
            return '禁止将所属栏目设置为自己';
        }

        return true;
    }
}