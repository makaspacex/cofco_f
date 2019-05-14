<?php

namespace app\cofco\model;

use think\Model;

/**
 * 日志记录
 * @package app\admin\model
 */
class AdminUserlog extends AdminBase
{
    // 定义时间戳字段名
    protected $createTime = 'time';
    protected $updateTime = 'ctime';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

}
