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
use Env;
use app\cms\model\CmsField as FieldModel;
use app\cms\model\CmsCategory as CategoryModel;
use app\cms\model\CmsContent as ContentModel;

/**
 * 模型
 * @package app\cms\model
 */
class CmsModel extends Base
{
    protected $hasStr = 'public function hasDiy{tableName}()
    {
        return $this->hasOne(\'CmsDiy{tableName}\', \'eid\', \'extend_id\');
    }';

    // 模型事件
    public static function init()
    {
        // 新增前
        self::event('before_insert', function ($obj) {

        	$tableName = config('database.prefix').'cms_diy_'.$obj['name'];

            try {

                // 创建表
                $sql = "CREATE TABLE `{$tableName}` (
                            `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
                            `delete_time` int(10) unsigned NOT NULL DEFAULT '0',
                            PRIMARY KEY (`eid`)
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
            
            if (isset($obj['mid']) && $obj['mid'] > 0) {
                $obj->copyModelField($obj);
            }

        });

        // 删除前
        self::event('before_delete', function ($obj) {
            return $obj->destroyModel($obj);
        
        });
    }

    /**
     * 复制模型字段
     */
    public function copyModelField($obj)
    {
        $rows = FieldModel::where('mid', $obj['mid'])
                ->field('group,title,name,options,type,value,is_must,tips,sort,validate_rule,max_length,remark,status')->select()->toArray();

        foreach($rows as $v) {
            $model = new FieldModel;
            $v['mid'] = $obj['id'];
            
            $model->save($v);
        }
        
    }

    /**
     * 生成model文件
     */
    public function bulidModel($obj)
    {

        // 将当前新增的模型的一对一关联追加到公共模型
        $baseFile       = Env::get('app_path').'cms/model/Base.php';
        $baseContent    = file_get_contents($baseFile);
        $tableName      = parse_name($obj['name'], 1);

        if (strpos($baseContent, 'hasDiy'.$tableName) !== false) {
            return true;
        }

        $str            = str_replace('{tableName}', $tableName, $this->hasStr);
        $newContent     = str_replace('//{content_extend}', $str."\r\r    //{content_extend}\r", $baseContent);

        try {

            file_put_contents($baseFile, $newContent);

        } catch (\think\exception\ErrorException $e) {

            if (stripos($e->getMessage(), 'Permission denied') !== false) {
                $obj->error = '[/application/cms/model/Base.php]没有写入权限';
                return false;
            }

            $this->error = $e->getMessage();
            return false;
        }

        // 生成模型文件
        $modelContent = <<<INFO
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
 * {$obj['title']}
 * @package app\cms\model
 */
class CmsDiy{$tableName} extends Base
{

}

INFO;

        try {

            file_put_contents(Env::get('app_path').'cms/model/CmsDiy'.$tableName.'.php', $modelContent);

        } catch (\think\exception\ErrorException $e) {

            // 恢复base模型
            file_put_contents($baseFile, $baseContent);

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
        FieldModel::destroy(['mid' => $obj['id']]);

        // 删除对应的模型栏目
        CategoryModel::destroy(['mid' => $obj['id']]);

        // 删除对应的模型类容
        ContentModel::destroy(['mid' => $obj['id']]);

        return true;

    }

    /**
     * 硬删除model文件及相关数据库
     */
    public function delModel($obj)
    {

        $tableName = parse_name($obj['name'], 1);
        $modelFile = Env::get('app_path').'cms/model/CmsDiy'.$tableName.'.php';

        // 清除公共模型的关联模型
        $baseFile       = Env::get('app_path').'cms/model/Base.php';
        $baseContent    = file_get_contents($baseFile);
        $str            = str_replace('{tableName}', $tableName, $this->hasStr);
        $newContent     = str_replace($str, '', $baseContent);

        file_put_contents($baseFile, $newContent);

        // 删除模型字段
        FieldModel::where('mid', $obj['id'])->delete();

        // 删除对应的模型类容
        // 删除对应的模型栏目
        
        // 删除数据表
        try {

            Db::execute('DROP TABLE `'.config('database.prefix').'cms_diy_'.$obj['name'].'`;');

        } catch (\think\exception\PDOException $e) {
            $obj->error = $e->getMessage();
            return false;

        }
        
        // 删除模型文件
        @unlink($modelFile);

        return true;
    }

}
