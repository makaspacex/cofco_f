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
use app\cofco\model\AdminSpiderTask as SpiderTaskModel;
use think\Model;
//use think\Loader;

/**
 * 钩子模型
 * @package app\admin\model
 */
class AdminKw extends Model
{
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = false;
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    public static function getOption($id = 0)
    {
        $rows = self::column('id,keywords');
        $str = '';
        foreach ($rows as $k => $v) {
            if ($id == $k) {
                $str .= '<option value="'.$v.'" selected>'.$v.'</option>';
            } else {
                $str .= '<option value="'.$v.'">'.$v.'</option>';
            }
        }
        return $str;
    }


}