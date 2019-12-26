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
use app\cms\model\CmsContent as ContentModel;
use app\cms\model\CmsCategory as CategoryModel;
use app\cms\model\CmsAttributeIndex as IndexModel;
use app\cms\model\CmsRec as RecModel;

use Env;
use hisi\Tree;
use hisi\Dir;

/**
 * 内容控制器
 * @package app\cms\admin
 */
class Content extends Admin
{
    protected $hisiModel = 'CmsContent';

    protected function initialize()
    {
        parent::initialize();

        $action = $this->request->action();
        
        if (($action == 'add' || $action == 'edit') && !$this->request->isPost()) {

            $hisiTabData['menu'] = [
                ['title' => '基础内容'],
                ['title' => '扩展类型'],
            ];

            $assign                     = [];
            $assign['hisiTabType']      = 2;
            $assign['hisiTabData']      = $hisiTabData;
            $assign['category']         = [];
            $assign['attributeIndex']   = [];
            $assign['hasContent']       = [];
            $assign['recMark']          = [];
            $assign['recPos']           = [];
            $assign['categorys']        = '';

            $id  = $this->request->param('id/d', 0);
            $cid = $this->request->param('cid/d', 0);
            $has = '';

            if ($id) {

                $indexs = [];
                $content= ContentModel::where('id', $id)->find();
                $cid    = $content['cid'];
                $rows   = IndexModel::where('content_id', $id)->field('id,item,value')->select();
                $has    = 'hasDiy'.parse_name($content->hasModel->name, 1);

                foreach ($rows as $k => $v) {

                    $indexs[$v['item']] = $v['value'];

                }

                $assign['attributeIndex']   = $indexs;

            }

            $category = CategoryModel::with('hasFields')->where('id', $cid)->find();

            if (isset($category['content_limit']) && $category['content_limit'] == 0) {

                return $this->error('禁止在当前栏目下添加内容');

            } else if ($category['content_limit'] == 1 && $action == 'add') {

                $content = ContentModel::where('cid', $category['id'])->find();
                if ($content) {
                    $this->redirect(url('edit?id='.$content['id']));
                }

            }

            if ($has && isset($content->$has)) {
                $hasContent = $content->$has->toArray();
                foreach($category['hasFields'] as $v) {
                    if ($v['type'] == 'checkbox') {
                        $hasContent[$v['name']] = json_decode($hasContent[$v['name']], 1);
                    }
                }
                $assign['hasContent'] = $hasContent;
                unset($assign['hasContent']['delete_time']);
            }

            if (isset($category['mid'])) {

                $posData  = RecModel::order('sort asc')
                            ->where('content_id', 0)
                            ->where('type', 1)
                            ->where('mid', 'in', [0, $category['mid']])
                            ->column('id,pid,title as name');

                $assign['recPos'] = Tree::ToTree($posData); 

                $categorys = CategoryModel::where('mid', $category['mid'])->column('id,pid,name');

                $assign['categorys'] = Tree::toOptions(Tree::toTree($categorys), $category['id']);
            }

            if ($category['type_id'] == 0) {

                $assign['hisiTabType'] = 1;

            }

            if ($action == 'edit') {
                $assign['recMark'] = RecModel::where('content_id', $id)->column('pid,content_id');
            }

            $assign['category']     = $category;
            $assign['templates']    = self::getTemplates();

            $this->assign($assign);

        }

    }

    public function index()
    {
        if ($this->request->isAjax()) {

            $where  = $data = [];
            $cid    = $this->request->param('cid/d', 0);
            $page   = $this->request->param('page/d', 1);
            $limit  = $this->request->param('limit/d', 20);
            $tag    = $this->request->param('tag/s');
            $recycle= $this->request->param('recycle/d', 0);
            $keyword= $this->request->param('keyword/s');

            if ($cid) {
            	$cids = CategoryModel::where('id', $cid)->value('childs');
            	$where[] = ['cid', 'in', $cids];
            }

            if ($tag) {
                $where[] = ['tag', 'like', '%'.$tag.'%'];
            }

            if ($keyword) {
                $where[] = ['title', 'like', '%'.$keyword.'%'];
            }
            
            if ($recycle == 1) {
                $data['data']   = ContentModel::onlyTrashed()->with(['hasCategory' => function($query) {
                                        $query->field('id,name,url,content_limit');
                                    }])->where($where)
                                    ->page($page)
                                    ->limit($limit)
                                    ->select();
            } else {
                $data['data']   = ContentModel::with(['hasCategory' => function($query) {
                                        $query->field('id,name,url,content_limit');
                                    }])->where($where)
                                    ->page($page)
                                    ->limit($limit)
                                    ->select();
            }
                                
            $data['count']  = ContentModel::where($where)->count('id');
            $data['code']   = 0;

            return json($data);

        }

    	$categorys 	= CategoryModel::order('sort asc')->column('id,pid,name,childs,content_limit');

    	$treeObj	= new Tree(['child' => 'children']);
    	$treeData	= $treeObj::ToTree($categorys);

        $assign = [
            'categorys' => $treeData,
            'hisiTabType' => 0,
        ];

        $this->assign($assign);
        
        return $this->fetch();
    }

    public function restore()
    {
        $id = $this->request->param('id/d', 0);

        $row = ContentModel::onlyTrashed()->find($id);

        if ($row->restore()) {
            return $this->success('数据已恢复');
        }

        return $this->error('数据恢复失败');
    }

    // 获取详情模板
    private static function getTemplates()
    {
    	$moduleInfo = module_info('cms');

    	$path = Env::get('root_path').'public/theme/cms/'.$moduleInfo['theme'].'/';
    	$show = Dir::getList($path.'show');
        $data = [];

    	// 详情模板
    	foreach ($show as $k => $v) {

    		$tpl = file_get_contents($path.'show/'.$v);

    		preg_match("/{\/\*\*\*\*\*(.*?)\*\*\*\*\*\/}/", $tpl, $match);

			$data[$v] = '';
    		
    		if (isset($match[1])) {
    			$data[$v] = ' - ' . $match[1];
    		}
    		
    	}

    	return $data;
    }

}
