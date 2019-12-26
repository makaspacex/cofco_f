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
use app\cms\model\CmsForm as FormModel;

/**
 * 表单字段模型
 * @package app\cms\model
 */
class CmsFormField extends Base
{
    // 定义表单类型与字段类型索引
	public $formType = [
            'input' 	=> 'varchar',
            'textarea' 	=> 'text',
            'password'  => 'varchar',
            'radio'     => 'varchar',
            'checkbox'  => 'varchar',
            'select'    => 'varchar',
            'hidden'    => 'varchar',
            'file'      => 'varchar',
            'image'     => 'varchar',
        ];

    // 模型事件
    public static function init()
    {

        // 新增后
        self::event('after_insert', function ($obj) {

            return $obj->addField($obj);
        
        });

        // 更新前
        self::event('before_update', function ($obj) {

            return $obj->changeField($obj);
        
        });

        // 删除前
        self::event('before_delete', function ($obj) {
        	return true;
            // 硬删除
            // return $obj->delField($obj);
        
        });

    }

    /**
     * 添加字段
     */
    public function addField($obj)
    {

        $tableName  = self::getTableFullName($obj['fid']);
        $length     = isset($obj['max_length']) && $obj['max_length'] ? $obj['max_length'] : 255;

        switch ($this->formType[$obj['type']]) {

            case 'varchar':

                $sql = " VARCHAR({$length}) DEFAULT '{$obj['value']}' AFTER `fid`";

                break;

            case 'int':

                $value = intval($obj['value']);
                $sql = " INT(11) UNSIGNED DEFAULT '{$value}' AFTER `fid`";

                break;

            case 'text':

                $sql = " TEXT AFTER `fid`";

                break;

            default:

                $obj->error = '表单类型不存在';

                return false;

                break;

        }

        try {

            Db::execute("ALTER TABLE `{$tableName}` ADD `{$obj['name']}`" . $sql);
    
        } catch (\think\exception\PDOException $e) {

            $obj->error = $e->getMessage();
            return false;

        }

        return true;
    }

    /**
     * 修改字段
     */
    public function changeField($obj)
    {

        $tableName  = self::getTableFullName($obj['fid']);
        $oldField   = self::where('id', $obj['id'])->value('name');
        $length     = isset($obj['max_length']) && $obj['max_length'] ? $obj['max_length'] : 255;

        switch ($this->formType[$obj['type']]) {

            case 'varchar':

                $sql = " VARCHAR({$length}) DEFAULT '{$obj['value']}'";

                break;

            case 'int':

                $value = intval($obj['value']);
                $sql = " INT(11) UNSIGNED DEFAULT '{$value}'";

                break;

            case 'text':

                $sql = " TEXT";

                break;

            default:

                $obj->error = '表单类型不存在';

                return false;

                break;

        }

        try {

            Db::execute("ALTER TABLE `{$tableName}`  CHANGE `{$oldField}` `{$obj['name']}`" . $sql);
    
        } catch (\think\exception\PDOException $e) {

            $obj->error = $e->getMessage();
            return false;

        }

        return true;

    }

    /**
     * 硬删除字段
     */
    public function delField($obj)
    {

        $tableName = self::getTableFullName($obj['fid']);

        try {

            Db::execute("ALTER TABLE `{$tableName}` DROP `{$obj['name']}`");
    
        } catch (\think\exception\PDOException $e) {

            $obj->error = $e->getMessage();
            return false;

        }

        return true;
    }

    /**
     * 获取对应模型的表全名
     */
    private function getTableFullName($fid)
    {

        $tableName  = FormModel::where('id', $fid)->value('table_name');
        return config('database.prefix').'cms_form_'.$tableName;

    }
}
