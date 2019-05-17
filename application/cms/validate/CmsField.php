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
 * 模型字段验证器
 * @package app\cms\validate
 */
class CmsField extends Validate
{
    //定义验证规则
    protected $rule = [
        'mid|所属模型' => [
            'require', 
            'number',
        ],
        'title|字段标题' => [
            'require', 
            'length' => '1,20', 
            'unique' => 'cms_field,mid^title',
        ],
        'name|字段名称' => [
            'require', 
            'length' => '1,30', 
            'regex' => '/^[A-Za-z\_]+$/',
            'checkSystemField' => 'thinkphp',
            'unique' => 'cms_field,mid^name',
        ],
        'max_length|字段长度' => [
            'requireWith' => 'max_length',
            'number',
        ],
    ];

    /**
     * 检查系统字段
     * @author 橘子俊 <364666827@qq.com>
     * @return stirng|array
     */
    protected function checkSystemField($value, $rule, $data)
    {
        $sys = [
            'id',
            'cid',
            'mid',
            'extend_id',
            'user_id',
            'title',
            'title_color',
            'tag',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'params',
            'url',
            'image',
            'flag',
            'template',
            'views',
            'likes',
            'dislike',
            'comments',
            'favs',
            'sort',
            'status',
            'timing',
            'create_time',
            'update_time',
            'delete_time',
            'lang',
        ];

        if (in_array($value, $sys)) {
            return '['.$value.']为系统字段';
        }

        return true;
    }
}
