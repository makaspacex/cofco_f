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

use think\Model;
use think\model\concern\SoftDelete;

/**
 * 公共基础模型
 * 凡是继承此模型的必须支持软删除
 * @package app\cms\model
 */
class Base extends Model
{

    use SoftDelete;

    protected $defaultSoftDelete = 0;
    
	public function hasModel()
	{
		return $this->hasOne('CmsModel', 'id', 'mid');
	}

	public function hasCategory()
	{
		return $this->hasOne('CmsCategory', 'id', 'cid');
	}

	public function hasFields()
	{
		return $this->hasMany('CmsField', 'mid', 'mid')->order('sort asc');
	}

    public function hasType()
    {
        return $this->hasOne('CmsType', 'id', 'type_id');
    }

    public function hasComments()
    {
        return $this->hasMany('CmsComment', 'content_id');
    }

    public function hasContent()
    {
        return $this->hasOne('CmsContent', 'id', 'content_id');
    }

    public function hasUser()
    {
        return $this->hasOne('\app\user\model\User', 'id', 'user_id');
    }

    public function hasAttrItems()
    {
        return $this->hasMany('CmsAttributeItem', 'type_id');
    }

    public function hasValues()
    {
        return $this->hasMany('CmsAttributeValue', 'item_id')->order('sort asc');
    }

    public function hasForm()
    {
        return $this->hasOne('CmsForm', 'id', 'fid');
    }

    public function hasFormFields()
    {
        return $this->hasMany('CmsFormField', 'fid')->order('sort asc');
    }

    public function hasContentFormFields()
    {
        return $this->hasMany('CmsFormField', 'fid', 'fid')->order('sort asc');
    }

    public function hasDiyArticle()
    {
        return $this->hasOne('CmsDiyArticle', 'eid', 'extend_id');
    }

    public function hasDiyPicture()
    {
        return $this->hasOne('CmsDiyPicture', 'eid', 'extend_id');
    }

    public function hasDiyPage()
    {
        return $this->hasOne('CmsDiyPage', 'eid', 'extend_id');
    }

    public function hasDiyProduct()
    {
        return $this->hasOne('CmsDiyProduct', 'eid', 'extend_id');
    }

    public function hasDiyVideo()
    {
        return $this->hasOne('CmsDiyVideo', 'eid', 'extend_id');
    }

    public function hasDiyDownload()
    {
        return $this->hasOne('CmsDiyDownload', 'eid', 'extend_id');
    }

    public function hasDiyDsdsdsd()
    {
        return $this->hasOne('CmsDiyDsdsdsd', 'eid', 'extend_id');
    }    //{content_extend}




    /**
     * 递归添加子ID
     * @param int $id 子ID
     * @param int $pid 父ID
     * @author 橘子俊 <364666827@qq.com>
     * @return string
     */
    public static function addChilds($id, $pid = 0)
    {

        if ($pid == 0) {

            $row = self::where('id', $id)->find();
            self::where('id', $id)->setField('childs', $id);

        } else {

            $row = self::where('id', $pid)->find();
            self::where('id', $pid)->setField('childs', $row['childs'].','.$id);

        }

        if ($row['pid'] > 0) {

            self::addChilds($id, $row['pid']);

        }

    }

    /**
     * 递归删除子ID
     * @param int $id 子ID
     * @param int $pid 父ID
     * @author 橘子俊 <364666827@qq.com>
     * @return string
     */
    public static function delChilds($id, $pid = 0)
    {

        if (!$pid) return true;

        $row = self::where('id', $pid)->find();

        $childs = explode(',', $row['childs']);
        $childs = implode(',', array_diff($childs, [$id]));

        self::where('id', $pid)->setField('childs', $childs);

        if ($row['pid'] > 0) {

            self::delChilds($id, $row['pid']);

        }

    }

}
