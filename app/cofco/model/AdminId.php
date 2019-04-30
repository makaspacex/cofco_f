<?php
namespace app\cofco\model;

use think\Model;
//use think\Loader;

/**
 * 钩子模型
 * @package app\admin\model
 */
class AdminId extends Model
{
    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

}