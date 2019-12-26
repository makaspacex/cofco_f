<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------

namespace app\cms\model;

use hisi\Tree;
use Cache;

/**
 * 推荐模型
 * @package app\cms\model
 */
class CmsRec extends Base
{

    protected $insert = ['lang' => HISI_LANG]; 

    protected function base($query)
    {
        $query->where('lang', HISI_LANG);
    }

    // 模型事件
    public static function init()
    {
        // 新增后
        self::event('after_insert', function ($obj) {

            if (!isset($obj->id)) {
                return false;
            }

            $obj->addChilds($obj->id);

            return true;
        });

        // 更新前
        self::event('before_update', function ($obj) {

            if ($obj->pid == $obj->id) {
                $obj->error = '禁止将所属栏目设置为自己';
                return false;
            }

            $pid = self::where('id', $obj->id)->value('pid');
            
            $obj->delChilds($obj->id, $pid);
            return true;

        });

        // 更新后
        self::event('after_update', function ($obj) {

            if ($obj->pid == 0) {
                return true;
            }

            $obj->addChilds($obj->id, $obj->pid);
            
            return true;
        
        });


        // 删除前
        self::event('before_delete', function ($obj) {

            if (strpos($obj->childs, ',')) {
                $obj->error = '请先删除当前推荐位下面的内容';
                return false;
            }

            return true;
        
        });

        // 删除后
        self::event('after_delete', function ($obj) {

            $obj->delChilds($obj->id, $obj->pid);

            // 强制删除
            db('CmsRec')->where('id', $obj->id)->delete();

            return true;
        
        });
    }

    /**
     * [标签库] 获取推荐列表
     * @date   2019-01-23
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  string     $name  调用名称
     * @param  integer    $return 返回数据结构[0不含当前推荐位，非0含当前推荐位]
     * @param  boolean    $cache 是否缓存
     * @return array
     */
    public static function tagGetList($name, $return = 0,  $cache = false)
    {

        $cacheName = md5($name);

        $data = Cache::get($cacheName);
        
        if ($data && $cache) {

            return $data;

        }

        $row = self::where('name', $name)->find();

        if (!$row) {

            return [];

        }

        $childs     = $row->childs;
        $where      = [];
        $where[]    = ['id', 'in', $childs];

        $with = [];
        $with['hasContent'] = function($query) {
            $query->field('id,cid,title,title_color,url,extend_id,views,likes,comments');
        };

        $with['hasModel'] = function($query) {
            $query->field('id,name');
        };

        $rows = self::with($with)->where($where)->order('sort asc')->field('id,mid,pid,content_id,childs,title,sub_title,image,sub_image,url,file,target,sort,remark')->select();

        $data = [];

        if ($rows) {

            $data = $rows->toArray();

        }
        
        $data = Tree::toTree($data);

        if ($return == 0 && isset($data[0]['childs'])) {
            $data = $data[0]['childs'];
        }

        if ($cache) {
            Cache::set($cacheName, $data);
        }

        return $data;

    }

}
