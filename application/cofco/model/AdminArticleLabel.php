<?php


namespace app\cofco\model;

use think\Db;

/**文章 标签表
 * Class AdminArtlabel
 * @package app\cofco\model
 */

class AdminArticleLabel extends AdminBase
{ // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = false;
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    public static function addLabel($art_id,$label_ids){
        $datalist = Array();
        $data = Array();
        $map['art_id'] = $art_id;
        $data['art_id'] = $art_id;
        if(is_array($label_ids)){
            foreach ($label_ids as $label_id){
                $data['label_id'] = $label_id;
                array_push($datalist,$data);
            }
        }

        return self::insertAll($datalist);
    }
}