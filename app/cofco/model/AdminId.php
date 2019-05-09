<?php
namespace app\cofco\model;


class AdminId extends AdminBase
{
    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

}