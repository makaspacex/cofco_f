<?php
namespace app\cofco\model;
use app\cofco\model\AdminPending as PendingModel;
use think\Model;
class AdminTag extends AdminBase
{
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = false;
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    public static function getAll()
    {
        return self::column('id,name');
    }


}