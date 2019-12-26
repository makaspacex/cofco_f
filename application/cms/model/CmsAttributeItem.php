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
use think\Db;

/**
 * 属性项模型
 * @package app\cms\model
 */
class CmsAttributeItem extends Base
{
	protected $autoWriteTimestamp = false;

    // 模型事件
    public static function init()
    {
        // 删除前
        self::event('before_delete', function ($obj) {
			Db::name('CmsAttributeValue')->where('item_id', $obj['id'])->delete();
            return true;
        });
	}
}
