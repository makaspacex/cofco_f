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
 * 导航模型
 * @package app\cms\model
 */
class CmsNav extends Base
{

    protected $insert = ['lang' => HISI_LANG]; 

    // 定义全局的查询范围
    protected function base($query)
    {
        $query->where('lang', HISI_LANG);
    }
	
    // 模型事件
    public static function init()
    {

        // 新增前
        self::event('before_insert', function ($obj) {

            $obj->autoSetGroups($obj);

            return true;
        });

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

            $obj->autoSetGroups($obj);

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
     * 自动设置分组
     */
    public function autoSetGroups($obj)
    {
        if ($obj->pid > 0) {

            $groups = self::where('id', $obj->pid)->value('groups');

            if ($groups) {

                $obj->groups = $groups;

            } else {

                $obj->groups = '';

            }

        }
    }

    /**
     * [模板标签]获取导航
     * @date   2019-01-12
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  [type]     $id    当前栏目id
     * @param  integer    $level 返回层级
     * @param  string     $field 指定返回字段
     * @return array
     */
    public function tagGetList($cache = false, $group = '')
    {
        $where = [];
        if ($group) {
            $where[] = ['groups', '=', $group];
        }

    	$rows = self::order('sort asc')->where($where)->cache($cache)->column('id,pid,title,target,url,image');

        return Tree::toTree($rows);
    }

}
