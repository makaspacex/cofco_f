<?php


namespace app\cofco\admin;
use app\cofco\model\AdminArticleLabel as ArticleLabelModel;
use think\Db;


/**
 * Class ArticleLabel
 * @package app\cofco\admin
 */

class Articlelabel extends AdminBase
{
    /**
     * 通过文章ID名查询标签
     */
    public function getLabelByArtID($art_id){
        $res = Db::field('a.*,b.value')
            ->table(['cofco_admin_article_label'=> 'a','cofco_admin_levellabel'=> 'b'])
            ->where('a.label_id = b.id and art_id='.$art_id)->select();
        return json($res);
    }



    /**
     * 删除标签
     */
    public function delLabel(){

    }
}