<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
namespace app\cofco\model;

use think\Model;
//use think\Loader;

/**
 * 钩子模型
 * @package app\admin\model
 */
class AdminSpiderTask extends Model
{
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = false;
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    public static function getAll()
    {
        return self::column('id,title');
    }
    public static function getOption()
    {

        $str = '';
        foreach (config('spider.spider_list') as $k => $v) {

                $str .= '<option value="'.$k.'" selected>'.$v.'</option>';

        }
        return $str;
    }




}