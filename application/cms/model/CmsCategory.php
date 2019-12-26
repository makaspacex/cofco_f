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

/**
 * 分类栏目模型
 * @package app\cms\model
 */
class CmsCategory extends Base
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

            // 含有子分类禁止删除
            if (strpos($obj->childs, ',')) {
                $obj->error = '请先删除当前栏目下的子栏目';
                return false;
            }

            // 如果分类下有内容禁止删除 TODO

            return true;
        
        });

        // 删除后
        self::event('after_delete', function ($obj) {
            $obj->delChilds($obj->id, $obj->pid);
            return true;
        
        });
    }

    /**
     * 根据子节点返回所有父节点
     * @date   2019-01-14
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int      $id   子节点id
     * @param  array    $data 数据集
     * @return array
     */
    public static function getParents($id, $data = [])
    {

        if (empty($data)) {

            $data = self::cache(600)->column('id,pid,name,url');

        }

        $trees = [];

        foreach ($data as $v) {

            if ($v['id'] == $id) {

                $trees[] = $v;

                $trees   = array_merge(self::getParents($v['pid'], $data), $trees);
            }
        }

        return $trees;
    }

    /**
     * [模板标签]获取子集栏目
     * @date   2019-01-12
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  [type]     $id    当前栏目id
     * @param  integer    $level 返回层级
     * @param  string     $field 指定返回字段
     * @return array
     */
    public function tagGetChilds($id = 0, $level = 0, $mid = 0, $field = '')
    {
        if ($field) {
            $field = ','.$field;
        }
            
        $where = [];

        if ($mid > 0) {
            $where[] = ['mid', '=', $mid];
        }

        if ($id) {

            $row = self::where('id', $id)->field('childs')->find();
            if (!$row) {
                return [];
            }

            $childs = array_diff(explode(',', $row->childs), [$id]);

            $rows = self::where('id', 'in', $childs)
                    ->where($where)
                    ->order('sort asc')
                    ->field('id,pid,name,url,jump_link' . $field)
                    ->select()
                    ->toArray();
        } else {

            $rows = self::order('sort asc')
                    ->where($where)
                    ->field('id,pid,name,url,jump_link' . $field)
                    ->select()
                    ->toArray();

        }

        return Tree::toTree($rows, $id, $level);
    }
}
