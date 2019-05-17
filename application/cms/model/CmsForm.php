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

use app\cms\model\CmsFormField as FieldModel;
use app\system\model\SystemMenu as SystemMenuModel;
use think\Db;
use Env;

/**
 * 表单模型
 * @package app\cms\model
 */
class CmsForm extends Base
{

    protected $insert = ['lang' => HISI_LANG];
    
    protected function base($query)
    {
        $query->where('lang', HISI_LANG);
    }

    // 模型事件
    public static function init()
    {
        // 新增前
        self::event('before_insert', function ($obj) {

        	$tableName = config('database.prefix').'cms_form_'.$obj['table_name'];

            try {

                // 创建表
                $sql = "CREATE TABLE `{$tableName}` (
                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                            `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '表单ID',
                            `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  							`ip` varchar(50) DEFAULT '' COMMENT 'ip地址',
                            `user_agent` varchar(300) DEFAULT '',
                            `read_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '阅读状态（1已读，0未读）',
                            `create_time` int(10) unsigned NOT NULL DEFAULT '0',
                            `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  							`delete_time` int(10) unsigned NOT NULL DEFAULT '0',
                            PRIMARY KEY (`id`)
                        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='{$obj['remark']}';";

                Db::execute($sql);

            } catch (\think\exception\PDOException $e) {
                
                if (stripos($e->getMessage(), 'already exists') === false) {
                    $obj->error = '可能没有创建表权限';
                    return false;
                }

            }

            // 生成模型
            return $obj->bulidModel($obj);
        });

        // 新增后
        self::event('after_insert', function ($obj) {
            
            if ($obj['is_menu'] == 1) {
                $obj->addSystemMenu($obj);
            } else {
                $obj->delSystemMenu($obj);
            }

        });

        // 更新前
        self::event('before_update', function ($obj) {
            
            if ($obj['is_menu'] == 1) {
                $obj->addSystemMenu($obj);
            } else {
                $obj->delSystemMenu($obj);
            }

        });

        // 删除前
        self::event('before_delete', function ($obj) {
            return $obj->destroyModel($obj);
        
        });
    }

    /**
     * 删除系统菜单
     */
    public function delSystemMenu($obj)
    {
        
        $row = SystemMenuModel::where('url', 'cms/formContent/index')->where('param', 'fid='.$obj['id'])->find();
        if (!$row) {
            return true;
        }

        // 删除下级菜单
        SystemMenuModel::where('pid', $row->id)->delete();

        // 删除当前菜单
        $row->delete();

        return true;

    }

    /**
     * 添加系统菜单
     */
    public function addSystemMenu($obj)
    {
        
        if (SystemMenuModel::where('url', 'cms/formContent/index')->where('param', 'fid='.$obj['id'])->find()) {
            return true;
        }

        $pid = (int)SystemMenuModel::where('url', 'cmsExtend')->where('module', 'cms')->value('id');

        if ($pid <= 0) {
            return;
        }

        $menu = [
            [
                'pid'   => $pid,
                'title' => $obj['title'],
                'icon' => 'aicon ai-caidan',
                'module' => 'cms',
                'url' => 'cms/formContent/index',
                'param' => 'fid='.$obj['id'],
                'target' => '_self',
                'debug' => 0,
                'system' => 0,
                'nav' => 1,
                'sort' => 100,
                'childs' => [
                    [
                        'title' => '查看',
                        'icon' => '',
                        'module' => 'cms',
                        'url' => 'cms/formContent/show',
                        'param' => 'fid='.$obj['id'],
                        'target' => '_self',
                        'debug' => 0,
                        'system' => 0,
                        'nav' => 0,
                        'sort' => 100,
                    ],
                    [
                        'title' => '编辑',
                        'icon' => '',
                        'module' => 'cms',
                        'url' => 'cms/formContent/edit',
                        'param' => 'fid='.$obj['id'],
                        'target' => '_self',
                        'debug' => 0,
                        'system' => 0,
                        'nav' => 0,
                        'sort' => 101,
                    ],
                    [
                        'title' => '删除',
                        'icon' => '',
                        'module' => 'cms',
                        'url' => 'cms/formContent/del',
                        'param' => 'fid='.$obj['id'],
                        'target' => '_self',
                        'debug' => 0,
                        'system' => 0,
                        'nav' => 0,
                        'sort' => 102,
                    ],
                ],
            ],
        ];

        SystemMenuModel::importMenu($menu, 'cms');
    }

    /**
     * 生成model文件
     */
    public function bulidModel($obj)
    {

        $tableName = parse_name($obj['table_name'], 1);
        
        // 生成模型文件
        $modelContent = <<<INFO
<?php

namespace app\cms\model;

/**
 * {$obj['title']}模型
 * @package app\cms\model
 */
class CmsForm{$tableName} extends Base
{
    protected \$autoWriteTimestamp = true;
}

INFO;

        try {

            file_put_contents(Env::get('app_path').'cms/model/CmsForm'.$tableName.'.php', $modelContent);

        } catch (\think\exception\ErrorException $e) {

            if (stripos($e->getMessage(), 'Permission denied') !== false) {
                $obj->error = '[/application/cms/model]没有写入权限';
                return false;
            }

            $this->error = $e->getMessage();
            return false;

        }

        return true;
    }

    /**
     * 软删除model
     */
    public function destroyModel($obj)
    {

        // 删除模型字段
        FieldModel::destroy(['fid' => $obj['id']]);

        // 删除对应的模型类容
        // 删除对应的模型栏目
        // 删除对应的模型文件
        return true;
    }

}
