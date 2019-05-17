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

use app\cms\model\CmsAttributeItem as ItemModel;
use app\cms\model\CmsAttributeValue as ValueModel;

/**
 * 扩展类型模型
 * @package app\cms\model
 */
class CmsType extends Base
{
	protected $autoWriteTimestamp = false;

    protected $insert = ['lang' => HISI_LANG];

    protected $type = [
        'params' => 'json',
    ];

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
                $obj->error = '数据异常';
                return false;
            }

            return $obj->saveAttribute($obj->id, input('post.'));

        });

        // 更新前
        self::event('before_update', function ($obj) {

            return $obj->saveAttribute($obj->id, input('post.'));

        });

        // 删除前
        self::event('before_delete', function ($obj) {
            
            return $obj->delAttribute($obj->id);

        });

    }

    /**
     * 删除扩展属性项和属性值
     * @date   2019-01-08
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $typeId 类型ID
     * @return bool
     */
    public function delAttribute($typeId)
    {
    	$itemModel = new ItemModel;
    	$valueModel = new ValueModel;

    	$itemModel->startTrans();

    	if ($itemModel->destroy(['type_id' => $typeId]) === false) {
    		$this->error = '规格项删除失败';
    		return false;
    	}

    	if ($valueModel->destroy(['type_id' => $typeId]) === false) {
    		$itemModel->rollback();
    		$this->error = '规格值删除失败';
    		return false;
    	}

    	$itemModel->commit();
    	$valueModel->commit();

    	return true;
    }

    /**
     * 保存扩展属性项和属性值
     * @date   2019-01-08
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @param  int     $typeId 类型ID
     * @param  array   $data   扩展属性数据
     * @return bool
     */
	public function saveAttribute($typeId, $data)
	{

		if (!$typeId) {
			$this->error = '类型ID不存在';
			return false;
		}

		if (!isset($data['attribute']) || empty($data['attribute'])) {
			return true;
		}

        foreach ($data['attribute'] as $k => $v) {

            if (!$v['values'] && $v['form_type'] != 3) {

                $this->error = '属性值不能为空';
                return false;

            }

            $itemData 				= [];
            $itemData['type_id'] 	= $typeId;
            $itemData['form_type'] 	= $v['form_type'];
            $itemData['name'] 		= $v['name'];
            $itemData['sort'] 		= $v['sort'];
            $itemData['search'] 	= isset($v['search']) && $v['form_type'] != 3 ? 1 : 0;

            $itemModel = new ItemModel;

            if (isset($v['id']) && $v['id']) {

                $result = $itemModel->save($itemData, ['id' => $v['id']]);
                $itemId = $v['id'];
            } else {

            	$result = $itemModel->save($itemData);
            	$itemId = $itemModel->id;
            }

            if ($result === false) {
                continue;
            }

            if ($v['form_type'] != 3) {

                $values = json_decode(htmlspecialchars_decode($v['values']), 1);

                foreach ($values as $kk => $vv) {

                    $valueData 				= [];
                    $valueData['type_id'] 	= $typeId;
                    $valueData['name'] 		= $vv['name'];
                    $valueData['sort'] 		= $vv['sort'];
                    $valueData['item_id'] 	= $itemId;

                    $valueModel = new ValueModel;

		            if (isset($vv['id']) && $vv['id']) {

		                $result = $valueModel->save($valueData, ['id' => $vv['id']]);

		            } else {

		            	$result = $valueModel->save($valueData);

		            }

                }
            }
        }

        return true;
	}
}
