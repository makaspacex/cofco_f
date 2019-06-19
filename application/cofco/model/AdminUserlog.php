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
    /**获取日志查询条件
     * @param $type 日志类型 *
     * 1.创建文献 2.初审文献
     * 3.标注文献 4.终审文献
     * @param $id 文章ID
     * @return array
     */
    public  static function _insertUserLog($type, $tid)
    {
        $map = [];
        $map['type'] = $type;
        $map['uID'] = getCurUser()['uid'];  //用户ID
        $map['tID'] = $tid;  //文章ID
        $map['ctime'] = time();
        $map['year'] = date('Y');
        $map['month'] = date('m');
        $map['day'] = date('d');
        return self::insert($map);
    }
}
