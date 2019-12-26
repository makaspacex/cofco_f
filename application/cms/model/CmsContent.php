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

use app\cms\model\CmsAttributeIndex as IndexModel;
use app\cms\model\CmsModel as ModelModel;
use app\cms\model\CmsField as FieldModel;
use app\cms\model\CmsCategory as CategoryModel;
use app\cms\model\CmsRec as RecModel;
use think\Db;

/**
 * 内容模型
 * @package app\cms\model
 */
class CmsContent extends Base
{
	protected $autoWriteTimestamp = true;

    protected $stopInit = false;

    protected $insert = ['lang' => HISI_LANG]; 
    
    protected $type = [
        'timing'  =>  'timestamp',
        'params' => 'json',
    ];

    protected function base($query)
    {
        $query->where('lang', HISI_LANG);
    }

    public function setFlagAttr($value)
    {
        $value = array_filter($value);
        if (is_array($value) && !empty($value)) {
            return ','.implode(',', array_filter($value)).',';
        }

        return '';
    }

    public function getFlagAttr($value)
    {
        if ($value) {
            return explode(',', trim($value, ','));
        }

        return '';
    }

    public function setTagAttr($value)
    {
        if ($value) {
            return ','.$value.',';
        }

        return '';
    }

    public function getTagAttr($value)
    {
        $value = trim($value, ',');
        if ($value) {
            return explode(',', $value);
        }

        return [];
    }

    public function setStatusAttr($value, $data)
    {
        if (isset($data['timing'])) {
            $timing = $data['timing'];
            if (!is_numeric($timing)) {
                $timing = strtotime($timing);
            }

            if ($timing <= $_SERVER['REQUEST_TIME']) {
                return 1;
            } else {
                return 2;
            }
        }

        return $value;
    }

    // 模型事件
    public static function init()
    {

        // 新增前
        self::event('before_insert', function ($obj) {

            // 检查单页数据
            $limit = CategoryModel::where('id', $obj->cid)->value('content_limit');

            if ($limit == 1) {

                if ($obj->where('cid', $obj->cid)->find()) {

                    $obj->error = '当前栏目已限制为单条内容';
                    return false;

                }

            } else if ($limit == 0) {

                    $obj->error = '禁止在当前栏目下添加内容';
                    return false;

            }

            return true;

        });

        // 新增后
        self::event('after_insert', function ($obj) {
            
            if (!isset($obj->id)) {

                $obj->error = '数据异常';
                return false;

            }

            // 保存标签
            $obj->saveTag($obj);

        	// 保存扩展属性
        	$postData = input('post.');

        	if (isset($postData['extend_attribute'])) {

	        	if ($obj->saveExtendAttribute($obj->id, $postData['extend_attribute']) === false) {
	        		return false;
	        	}

        	}

            // 保存推荐
            if (isset($postData['rec'])) {

                $obj->saveRec($obj, $postData['rec']);
                
            }

        	// 保存扩展内容
        	if (!isset($postData['extend_content'])) {
                $postData['extend_content'] = [];
        	}

            if ($obj->saveExtendContent($obj, $postData['extend_content']) === false) {
                return false;
            }

        });

        // 更新前
        self::event('before_update', function ($obj) {

            if ($obj->stopInit === true) return true;

        	// 保存扩展属性
        	$postData = input('post.');

        	if (isset($postData['extend_attribute'])) {

	        	if ($obj->saveExtendAttribute($obj['id'], $postData['extend_attribute']) === false) {
	        		return false;
	        	}

        	}

            // 保存标签
            $obj->saveTag($obj);

            // 保存推荐
            if (isset($postData['rec'])) {

                $obj->saveRec($obj, $postData['rec']);
                
            }

            // 保存扩展内容
            if (!isset($postData['extend_content'])) {
                $postData['extend_content'] = [];
            }

            if ($obj->saveExtendContent($obj, $postData['extend_content']) === false) {
                return false;
            }

            return true;

        });

        // 删除前
        self::event('before_delete', function ($obj) {

            if ($obj['delete_time'] > 0) {
                return $obj->forceDelete($obj);
            }

            return true;
        });

    }

    /**
     * 强制删除数据
     * @date   2019-02-27
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  object   $obj 当前模型对象
     * @return bool
     */
    public function forceDelete($obj)
    {

        $tableName = self::getExtendTableName($obj['mid']);

        // 删除扩展表
        db('cms_diy'.$tableName)->where('eid', $obj['extend_id'])->delete();

        // 删除主表
        db('cms_content')->where('id', $obj['id'])->delete();

        return true;
    }


    /**
     * 保存推荐
     * @date   2019-02-27
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  object   $obj 当前模型对象
     * @param  array    $position 推荐位
     */
    public function saveRec($obj, $position)
    {

        $recData = RecModel::where('content_id', $obj->id)->field('id,pid,childs')->select();

        foreach ($recData as $k => $v) {

            $key = array_search($v->pid, $position);

            if ($key === false) {

                $v->delete(true);

            } else {

                unset($position[$key]);

            }

        }

        foreach ($position as $v) {

            $sqlmap = [
                'type'      => 2,
                'pid'       => $v,
                'mid'       => $obj['mid'],
                'content_id'=> $obj->id,
                'title'     => $obj['title'],
                'image'     => $obj['image'],
                'url'       => $obj->hasCategory->url.'/'.$obj->id,
            ];

            (new RecModel)->save($sqlmap);
        }

    }

    /**
     * 保存标签
     * @date   2019-01-18
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  object   $obj 当前模型对象
     */
    public function saveTag($obj)
    {
        if (isset($obj->tag) && $obj->tag) {

            if (is_string($obj->tag)) {
                $obj->tag = explode(',', str_replace('，', ',', $obj->tag));
            }

            foreach ($obj->tag as $v) {

                try {

                    Db::name('CmsTag')->insert(['name' => $v, 'mid' => $obj->mid]);

                } catch (\think\exception\PDOException $e) {
                    // 数据库name字段设置了唯一，所以会出现异常错误

                    // 统计文档数
                    $count = self::where('mid', '=', $obj->mid)->where('tag', 'like', '%,'.$v.',%')->count('id');

                    Db::name('CmsTag')->where(['name' => $v, 'mid' => $obj->mid])->update(['doc_count' => $count]);
                
                }

            }
        }
    }

    /**
     * 保存扩展属性
     * @date   2019-01-09
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $contentId 内容ID
     * @return bool
     */
    public function saveExtendAttribute($contentId, $attribute = [])
    {

        $attr = [];

        foreach ($attribute as $k => $v) {

            if (!$v) {
                continue;
            }

            $where = [
                'content_id' => $contentId,
                'item' => $k,
            ];

            $rowId = IndexModel::where($where)->value('id');

            if ($rowId) {
                $where['id'] = $rowId;
            }

            $where['value'] = $v;
            $attr[] = $where;
        }

        if (count($attr) > 0) {
        	$indexModel = new IndexModel;
        	$indexModel->saveAll($attr);
        }

    	return true;
    }

    /**
     * 保存扩展内容
     * @date   2019-01-09
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $contentId 内容ID
     * @return bool
     */
    public function saveExtendContent($obj, $data = [])
    {

        $obj->stopInit();

        if (empty($data)) {
            return true;
        }
        
        if (empty($obj->url)) {

            $obj->url = $obj->id;
            $obj->force()->save();

        }

    	$tableName = self::getExtendTableName($obj['mid']);

    	if (!$tableName) {

    		$obj->error = '模型ID不存在['.$obj['mid'].']';
    		return false;

    	}

    	$has = 'hasDiy'.$tableName;

        $fields = FieldModel::where('mid', $obj['mid'])
                    ->where("type = 'images' or type = 'checkbox'")
                    ->column('name,type');

        foreach ($fields as $k => $v) {

            $val = [];
            
            if ($v == 'images' && isset($data[$k]['path'])) {
            
                $val = [];
            
                foreach ($data[$k]['path'] as $kk => $vv) {
            
                    $val[] = [
                        'path' => $vv, 
                        'desc' => $data[$k]['desc'][$kk]
                    ];
            
                }
            
            }  else if (isset($data[$k])) {
            
                $val = $data[$k];
            
            }

            $data[$k] = json_encode($val, 1);
        }

    	// 数据验证 TODO

    	if ($obj['extend_id']) {
    		
    		$result = $obj->$has->save($data);

    	} else {

    		$result = $obj->$has()->save($data);

            if (isset($result['id'])) {

                $obj->extend_id = $result['id'];
                $obj->force()->save();

                return true;

            }

    	}

    	return true;
    }

    private function stopInit()
    {
        $this->stopInit = true;
    }

    /**
     * 获取扩展内容表名
     * @date   2019-01-09
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $mid 模型ID
     * @return string|null
     */
    public function getExtendTableName($mid)
    {
    	$tableName = ModelModel::where('id', $mid)->value('name');
    	return parse_name($tableName, 1);
    }

    /**
     * 获取扩展表内容
     * @date   2019-02-11
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $id 内容ID
     * @return array
     */
    public function getDiyContent($id)
    {
        $row = self::where('id', $id)->find();

        if (!$row) {
            return [];
        }

        $tableName = self::getExtendTableName($row['mid']);

        if (!$tableName) {
            $obj->error = '模型ID不存在['.$obj['mid'].']';
            return [];
        }

        $has = 'hasDiy'.$tableName;

        if (!$row->$has) {
            return [];
        }

        return $row->$has->toArray();
    }

    /**
     * 获取上一条内容
     * @date   2019-02-11
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $id   内容ID
     * @param  int     $cid  分类ID
     * @param  string  $field 返回字段(仅限主表字段)
     * @param  string  $sort 排序字段
     * @return array
     */
    public static function getPrev($id, $cid, $field = '', $sort = 'id')
    {
        $where      = [];
        $where[]    = ['id', '<', $id];
        $where[]    = ['cid', '=', $cid];
        $where[]    = ['status', '=', 1];

        $fields = ['id', 'title', 'url', 'cid', 'create_time'];

        if ($field) {
            $field = explode(',', $field);
            $fields = array_merge($fields, $field);
        }

        $row = self::where($where)->order($sort . ' desc')->field($fields)->find();

        $data           = [];
        $data['url']    = '';
        $data['title']  = '没有了';

         if ($row) {
            $data           = $row->toArray();
            $data['url']    = url($row->hasCategory['url'].'/'.$row->url);
        }

        $data['string'] = '<a class="prev" href="'.($data['url'] ? $data['url'] : 'javascript:;').'">'.$data['title'].'</a>';

        return $data;
    }

    /**
     * 获取下一条内容
     * @date   2019-02-11
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $id   内容ID
     * @param  int     $cid  分类ID
     * @param  string  $field 返回字段(仅限主表字段)
     * @param  string  $sort 排序字段
     * @return array
     */
    public static function getNext($id, $cid, $field = '', $sort = 'id')
    {
        $where      = [];
        $where[]    = ['id', '>', $id];
        $where[]    = ['cid', '=', $cid];
        $where[]    = ['status', '=', 1];

        $fields = ['id', 'title', 'url', 'cid', 'create_time'];

        if ($field) {
            $field = explode(',', $field);
            $fields = array_merge($fields, $field);
        }

        $row = self::where($where)->order($sort . ' asc')->field($fields)->find();

        $data           = [];
        $data['url']    = '';
        $data['title']  = '没有了';

        if ($row) {
            $data           = $row->toArray();
            $data['url']    = url($row->hasCategory['url'].'/'.$row->url);
        }

        $data['string'] = '<a class="next" href="'.($data['url'] ? $data['url'] : 'javascript:;').'">'.$data['title'].'</a>';

        return $data;
    }
}
