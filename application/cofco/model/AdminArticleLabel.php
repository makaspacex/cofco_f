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
        $data['art_id'] = $art_id;
        if(is_array($label_ids)){
            foreach ($label_ids as $label_id){
                $data['label_id'] = $label_id;
                array_push($datalist,$data);
            }
        }
        return self::insertAll($datalist);
    }

    public static function delLabel($art_id,$label_ids){
        $maps = [];
        $maps['art_id'] = $art_id;
        //$maps['label_id'] = array_unshift($label_ids,'IN');
        $maps['label_id'] = $label_ids;
        return self::where($maps)->delete();
    }



    public static function getLabelByArtID($art_id){
        $res = Db::table(['cofco_admin_article_label'=> 'a','cofco_admin_levellabel'=> 'b'])
            ->field('a.*,b.value')
            ->where('a.label_id = b.id and art_id=\''.$art_id.'\'')->select();
       return $res;
    }

    public static function label(){
        $res = Db::field('a.*,b.value')
            ->table(['cofco_admin_article_label'=> 'a','cofco_admin_levellabel'=> 'b'])
            ->where('a.label_id = b.id and art_id=')->select();
        return $res;
    }

}