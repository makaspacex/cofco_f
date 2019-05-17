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

namespace app\cms\admin;

use app\system\admin\Admin;
use app\cms\model\CmsCategory as CategoryModel;
use app\cms\model\CmsModel as ModelModel;
use app\cms\model\CmsType as TypeModel;
use Env;
use hisi\Dir;
use hisi\Tree;

/**
 * 分类栏目控制器
 * @package app\cms\admin
 */
class Category extends Admin
{
    protected $hisiModel 	= 'CmsCategory';
    protected $hisiValidate = 'CmsCategory';
    protected $hisiEditScene= 'edit';

    protected function initialize()
    {
        parent::initialize();

        $action = $this->request->action();

        if (($action == 'add' || $action == 'edit') && !$this->request->isPost()) {

        	$where = [];

        	// 获取所有分类
        	$categorys 	= CategoryModel::where($where)->column('id,pid,name');
        	$treeData 	= Tree::ToTree($categorys);

            $hisiTabData['menu'] = [
                ['title' => '基础信息'],
                ['title' => '其他设置'],
            ];

            $id  = $this->request->param('id/a');
            $pid = $this->request->param('pid/d');

            $assign                     = [];
            $assign['hisiTabType']      = 2;
            $assign['hisiTabData']      = $hisiTabData;
            $assign['templates']        = $this->getTemplates();
            $assign['categorySelect']   = Tree::toOptions($treeData, $pid, $id);
            $assign['modelSelect']      = ModelModel::where('status',1)->order('sort asc')->column('id,title');
            $assign['typeSelect']       = TypeModel::where('status',1)->order('sort asc')->column('id,name');

            $this->assign($assign);

        }

    }

    public function index()
    {
        if ($this->request->isAjax()) {

            $where      = $data = [];
            $pid        = $this->request->param('pid/d', 0);

            $where[] = ['pid', '=', $pid];

            $data['data']   = CategoryModel::with('hasModel')->where($where)->order('sort asc')->select();
            $data['code']   = 0;
            
            return json($data);

        }
        
        return $this->fetch();
    }

    // 获取所有模板
    private function getTemplates()
    {
    	$moduleInfo = module_info('cms');

    	$path = Env::get('root_path').'public/theme/cms/'.$moduleInfo['theme'].'/';

    	$list = Dir::getList($path.'list');
    	$poly = Dir::getList($path.'poly');
    	$show = Dir::getList($path.'show');

    	$data['list'] = [];
    	$data['poly'] = [];
    	$data['show'] = [];

    	// 列表模板
    	foreach ($list as $k => $v) {

    		$tpl = file_get_contents($path.'list/'.$v);

    		preg_match("/{\/\*\*\*\*\*(.*?)\*\*\*\*\*\/}/", $tpl, $match);

			$data['list'][$v] = '';
    		
    		if (isset($match[1])) {
    			$data['list'][$v] = ' - ' . $match[1];
    		}
    		
    	}

    	// 聚合模板
    	foreach ($poly as $k => $v) {

    		$tpl = file_get_contents($path.'poly/'.$v);

    		preg_match("/{\/\*\*\*\*\*(.*?)\*\*\*\*\*\/}/", $tpl, $match);

			$data['poly'][$v] = '';

    		if (isset($match[1])) {
    			$data['poly'][$v] = ' - ' . $match[1];
    		}
    		
    	}

    	// 详情模板
    	foreach ($show as $k => $v) {

    		$tpl = file_get_contents($path.'show/'.$v);

    		preg_match("/{\/\*\*\*\*\*(.*?)\*\*\*\*\*\/}/", $tpl, $match);

			$data['show'][$v] = '';
    		
    		if (isset($match[1])) {
    			$data['show'][$v] = ' - ' . $match[1];
    		}
    		
    	}

    	return $data;
    }
}