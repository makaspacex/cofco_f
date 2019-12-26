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
 * 碎片验证器
 * @package app\cms\validate
 */
class CmsBlock extends Validate
{
    //定义验证规则
    protected $rule = [
        'name|别名' => [
            'require', 
            'length' => '1,30', 
            'regex' => '/^[A-Za-z0-9\_]+$/',
            'unique' => 'cms_block,name',
        ],
        'title|名称' => [
            'require', 
            'length' => '1,20', 
            'unique' => 'cms_block,title',
        ],
        'content1|碎片内容' => [
            'requireIf' => 'type,1'
        ],
        'content2|碎片内容' => [
            'requireIf' => 'type,2'
        ],
        'content3|碎片内容' => [
            'requireIf' => 'type,3'
        ],
    ];
}
