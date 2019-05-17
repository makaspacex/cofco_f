<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------

namespace app\cms\admin;

use app\common\controller\Common;
use app\cms\model\CmsCategory as CategoryModel;
use app\system\model\SystemUser as SystemUserModel;
use app\cms\model\CmsType as TypeModel;
use app\cms\model\CmsAttributeItem as AttrItemModel;


/**
 * ajax控制器
 * @package app\cms\admin
 */
class Ajax extends Common
{
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        $model = new SystemUserModel();

        // 判断登陆
        $login = $model->isLogin();
        if (!$login['uid']) {
            return $this->error('请登陆之后操作', ROOT_DIR.config('sys.admin_path'));
        }

        if (!$this->request->isAjax()) {
        	return $this->error('非法请求');
        }
    }

    public function category($pid = 0)
    {
        $data = [];
        $data['data'] = CategoryModel::where('pid', $pid)->order('sort asc')->field('id,name,pid')->select();
        return json($data);
    }

    /**
     * 获取扩展类型
     * @date   2019-01-08
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @return json
     */
    public function typeInfo($id = 0)
    {

        $type   = TypeModel::get($id);

        if (!$type) {
        	return json([]);
        }
        
        $data               = [];
        $data['params']     = $type['params'];
        $data['attribute']  = AttrItemModel::with('hasValues')
                                ->where('type_id', $id)
                                ->order('sort asc')
                                ->field('id,name,form_type,type_id')
                                ->select();

        return json($data);

    }
}