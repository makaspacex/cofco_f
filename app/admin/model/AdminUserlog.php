<?php

namespace app\admin\model;

use think\Model;

/**
 * 日志记录
 * @package app\admin\model
 */
class AdminUserlog extends Model
{
    // 定义时间戳字段名
    protected $createTime = 'time';
    protected $updateTime = 'ctime';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

}
