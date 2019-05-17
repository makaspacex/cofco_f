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

/**
 * 属性索引模型
 * @package app\cms\model
 */
class CmsAttributeIndex extends Base
{
	protected $autoWriteTimestamp = false;

	public function setValueAttr($value)
	{
		if (is_array($value)) {
			return implode(',', $value);
		}
		return $value;
	}

	public function getValueAttr($value)
	{
		if (strpos($value, ',')) {
			return explode(',', $value);
		}
		return $value;
	}

    public function hasContent()
    {
        return $this->hasOne('\app\cms\model\CmsContent', 'id', 'content_id');
    }

    public static function lists($params)
    {
        $join = [];
        $count = 0;

        foreach ($params as $k => $v) {
            
            $item = str_replace('attr', '', $k);

            if (is_numeric($item)) {
                $join[] = '( `item` = '.$item.' AND `value` like "%'.$v.'%")';
                $count++;
            }

        }

        $result = [];

        if ($join) {

            $result = self::where(JOIN(" OR ", $join))
                        ->group('content_id')
                        ->cache(600)
                        ->having('count(content_id) >= ' . $count)
                        ->column('content_id');

            if (!$result) {
                $result = [0];
            }
        }

        return $result;
    }
}