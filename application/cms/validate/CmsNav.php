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
 * 导航验证器
 * @package app\cms\validate
 */
class CmsNav extends Validate
{
    //定义验证规则
    protected $rule = [
        'pid' => [
            'require',
            'number',
        ],
        'groups|幻灯片分组' => [
            'requireWith' => 'groups',
            'regex' => '/^[a-z\_]+$/',
            'length' => '1,30', 
        ],
        'title|导航标题' => [
            'require', 
            'length' => '1,50', 
            'unique' => 'cms_nav,url^pid',
        ],
        'url|导航地址' => [
            'require',
            'unique' => 'cms_nav,url^pid',
        ],
        'sort|排序设置' => [
            'require',
            'number',
        ],
    ];
}
