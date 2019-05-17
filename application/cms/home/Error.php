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

namespace app\cms\home;

use app\cms\model\CmsCategory as CategoryModel;
use app\cms\model\CmsContent as ContentModel;
use app\cms\model\CmsAttributeItem as ItemModel;
use app\cms\model\CmsAttributeValue as ValueModel;
use app\cms\model\CmsAttributeIndex as IndexModel;
use think\Template;
use Env;

/**
 * 栏目和内容控制器
 */
class Error extends Base
{

    public function _empty()
    {
    	$path = $this->request->path();
        if (substr($path, 0, 4) == 'cms/') {
            $path = substr($path, 4);
        }

    	$cat = CategoryModel::where('url', $path)->find();
    	if (!$cat) {

    		$contr 		= strtolower($this->request->controller());
    		$act 		= strtolower($this->request->action());
    		$cat 		= CategoryModel::where('url', $contr)->find();
    		$content 	= ContentModel::where('url', $act)->find();

    		if (!$cat && $act != 'index' && !$content) {

                $url = $path = explode('/', $path);

                if (end($path)) {

                    $content = ContentModel::where('url', end($path))->find();
                    if (!$content) {

                        abort(404, '页面不存在');
                        exit();

                    }
                    
                    array_pop($url);
                    $url = implode('/', $url);

                    $cat = CategoryModel::where('url', $url)->find();

                } else {

                    abort(404, '页面不存在');
                    exit();

                }

    		}

    		if (!$content && !$cat) {

				abort(404, '页面不存在');
				exit();

    		} else if ($content && $cat) {

    			if ($content->cid != $cat->id || $content->status != 1) {

					abort(404, '数据异常');
					exit();

    			}

    			return $this->show($content, $cat);

    		} else {

				abort(400, '未知错误');
				exit();

    		}

    	}

        $tpl = $cat->poly_template ? 'poly/'.$cat->poly_template : 'list/'.$cat->list_template;

		if ( strlen($tpl) == 5 ) {

            abort(404, '请指定栏目模板');
			exit();

		}

        $assign = [];
        $assign['attrIndexs'] = [];
        $assign['category'] = $cat;

        if ($cat->type_id > 0) {

            $param = $this->request->except(['page', 'hot', 'top', 'order']);

            $assign['attrIndexs'] = IndexModel::lists($param);

        }

        if ($cat->content_limit == 1) {// 单页直接获取内容详情

            $content = ContentModel::where('cid', $cat->id)->where('status', 1)->order('sort asc')->find();

            if (!$content) {

                abort(404, '单页内容不存在');
                exit();

            }

            $assign['content'] = $content ? $this->getContent($content, $cat) : [];
            
        }


        $this->assign($assign);

        return $this->fetch(str_replace('.html', '', $tpl));

    }

    public function show($content, $cat)
    {

    	if (empty($cat->show_template)) {

            abort(404, '请指定详情页模板');
            exit();

    	}

    	$assign 			= [];
    	$assign['content'] 	= $this->getContent($content, $cat);
    	$assign['category'] = $cat->toArray();

        $this->assign($assign);
        
        $template = $content->template ? $content->template : $cat->show_template;
        $template = str_replace('.html', '', $template);

    	return $this->fetch('show/'.$template);

    }

    private function getContent($content, $cat)
    {

        ContentModel::where('id', $content->id)->setInc('views');

        $diyContent = $content->getDiyContent($content->id);
        
        foreach ($diyContent as $k => $v) {
            $content->$k = $v;
        }

        if ($cat->type_id > 0) {

            $index  = IndexModel::where('content_id', $content->id)->column('item,value');
            $items  = ItemModel::where('id', 'in', array_keys($index))->column('id,name');
            $values = ValueModel::where('id', 'in', array_values($index))->column('item_id,name');
            $attribute = [];
            
            foreach ($items as $k => $v) {

                $attribute[] = [
                    'name' => $v,
                    'value'=> isset($values[$k]) ? $values[$k] : '',
                ];

            }

            $content->attribute = $attribute;

        }

        $content->prev = ContentModel::getPrev($content->id, $content->cid);
        $content->next = ContentModel::getNext($content->id, $content->cid);

        return $content;
    }
}
