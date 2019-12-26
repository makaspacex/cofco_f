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

namespace app\cms\taglib;

use think\template\TagLib;

/**
 * HisiCms标签库解析类
 * @author 橘子俊 <364666827@qq.com>
 */
class Hisi extends TagLib
{
    // 标签定义
    protected $tags = [
        //标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次 
		'list'	=> [//内容列表
			'attr'	=> 'cid,mid,orderby,attr,keyword,limit,pagesize,field,flag,tag,where,id,key,index',
			'close'	=> 1,
		],
        'category' => [// 分类列表
        	'attr' => 'cid,mid,type,alias,level,field,id,key,index',
        	'close' => 1,
        ],
        'tag' => [// 标签
        	'attr' => 'mid,limit,orderby,id,key,index',
        	'close' => 1,
        ],
        'block' => [// 碎片
            'attr' => 'name',
            'close' => 0,
        ],
        'nav' => [// 导航
			'attr'	=> 'group,cache,id,key,index',
			'close'	=> 1,
        ],
        'slide' => [// 幻灯片
            'attr'  => 'group,type,limit,orderby,id,key,index',
            'close' => 1,
        ],
        'link' => [// 友情链接
            'attr'  => 'group,type,limit,orderby,id,key,index',
            'close' => 1,
        ],
		'position'  => [//当前位置
			'attr'  => 'cid,title,url,sep',
			'close' => 0,
		],
        'rec' => [// 推荐
        	'attr' => 'name,type,id,key,index',
        	'close' => 1,
        ],
        'form' => [// 表单
			'attr'	=> 'name,orderby,id,key,index',
			'close'	=> 1,
        ],
        'formdata' => [// 表单数据列表
			'attr'	=> 'name,orderby,where,cache,limit,pagesize,id,key,index',
			'close'	=> 1,
        ],
        'type' => [// 栏目扩展类型
        	'attr' => 'tid,id,key,index',
        	'close' => 1,
        ],
    ];


    /* 推荐 */
    public function tagRec($tag, $content)
    {
    	$name   = isset($tag['name']) ? $tag['name'] : '';
    	$type   = isset($tag['type']) ? $tag['type'] : 0;
    	$cache  = isset($tag['cache']) ? $tag['cache'] : 'false';
        $id 	= isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php

			\$hisiRecModel = new \app\cms\model\CmsRec;
			
			\$hisiRec = \$hisiRecModel::tagGetList('$name', $type, $cache);
			
			\$$index = 0;

			foreach(\$hisiRec as \$$key => $$id):
            
				++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;

    }

    /* 标签 */
    public function tagTag($tag, $content)
    {
    	$mid 	= isset($tag['mid']) ? $tag['mid'] : 2;
    	$limit 	= isset($tag['limit']) ? $tag['limit'] : 10;
    	$order  = isset($tag['orderby']) ? $tag['orderby'] : 'search_count desc';
        $id     = isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php
		\$hisiTag = (new \app\cms\model\CmsTag)->where('mid', $mid)->limit($limit)->order('$order')->select();
			
		\$$index = 0;

		foreach(\$hisiTag as \$$key => $$id):

			\${$id}['url'] = '/tag/'.urlencode(\${$id}['name']);

			++\$$index;

?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;
    }


    /* 内容列表 */
    public function tagList($tag, $content)
    {
        $cid        = isset($tag['cid']) ? $tag['cid'] : 0;
        $mid        = isset($tag['mid']) ? $tag['mid'] : 0;
        $model 		= isset($tag['model']) ? $tag['model'] : '';
        $order 		= isset($tag['orderby']) ? $tag['orderby'] : 'id desc';
    	$keyword 	= isset($tag['keyword']) ? $tag['keyword'] : '';
    	$limit  	= isset($tag['limit']) ? $tag['limit'] : 20;
    	$pagesize	= isset($tag['pagesize']) ? $tag['pagesize'] : 0;
    	$flag		= isset($tag['flag']) ? $tag['flag'] : '';
    	$where 		= isset($tag['where']) ? $tag['where'] : '[]';
    	$attr 		= isset($tag['attr']) ? $tag['attr'] : '[]';
        $field 		= isset($tag['field']) ? $tag['field'] : '';
        $id         = isset($tag['id']) ? $tag['id'] : 'r';
        $key        = isset($tag['key']) ? $tag['key'] : 'key';
        $index      = isset($tag['index']) ? $tag['index'] : 'i';
    	$tag		= isset($tag['tag']) ? $tag['tag'] : '';

    	$parseStr = <<<INFO
		<?php
			
			\$hisiListWhere = [];
            \$hisiListWhere[] = ['status', '=', 1];
			\$diyTable = '';
			\$pages = '';
            \$modelId = (int)$mid;
			\$hisiListField = 'id,cid,mid,extend_id,title,tag,title_color,url,flag,image,views,likes,comments,favs,create_time,update_time,timing';
			\$hisiModel = new \app\cms\model\CmsModel;

			if (!empty("$field")) {
				\$hisiListField .= ",{$field}";
			}

			if (!empty("$flag")) {
				\$hisiListWhere[] = ['flag', 'like', "%{$flag}%"];
			}

			if (!empty($attr)) {
				\$hisiListWhere[] = ['id', 'in', $attr];
			}

            if (\$modelId > 0) {
                \$hisiListWhere[] = ['mid', '=', \$modelId];
            } else if (!empty('$model')) {
                \$modelId = (int)\$hisiModel::where('name', '$model')->value('id');
                \$hisiListWhere[] = ['mid', '=', \$modelId];
            }

			
			if (!empty("$keyword")) {
				\$hisiListWhere[] = ['title', 'like', "%{$keyword}%"];
			}
			
			if (!empty("$tag")) {
				\$hisiListWhere[] = ['tag', 'like', ",%{$tag}%,"];
			}

			\$hisiContentModel = new \app\cms\model\CmsContent;
            \$diyTable = '';

			if ($cid > 0) {

				\$hisiListCategoryModel = new \app\cms\model\CmsCategory;
				\$hisiListCategory = \$hisiListCategoryModel->where('id', $cid)->find();

				if (\$hisiListCategory['childs']) {
					\$hisiListWhere[] = ['cid', 'in', \$hisiListCategory['childs']];
				}
				
				if (isset(\$hisiListCategory->hasModel) && \$hisiListCategory->hasModel) {
					\$diyTable = \$hisiListCategory->hasModel['name'];
				}


			} else if (\$modelId > 0) {

				\$diyTable = \$hisiModel::where('id', \$modelId)->value('name');

			} else {

                echo 'mid、model、cid至少传一个';
                
            }

			if (\$diyTable) :

				\$diyTable = config('database.prefix').'cms_diy_'.\$diyTable;
				
				if ($pagesize > 0) {

					\$pageConfig = [
						'query' => input('param.'),
						'type'  => "\app\cms\util\Page"
					];
					
					\$hisiList = \$hisiContentModel
										->with('hasCategory')
										->alias('c')
										->join([\$diyTable => 'diy'], 'c.extend_id = diy.eid')
										->where(\$hisiListWhere)
										->where($where)
										->orderRaw('$order')
										->field(\$hisiListField)
										->paginate($pagesize, false, \$pageConfig);

					\$pages = \$hisiList->render();

				} else {

					\$hisiList = \$hisiContentModel
										->with('hasCategory')
										->alias('c')
										->join([\$diyTable => 'diy'], 'c.extend_id = diy.eid')
										->where(\$hisiListWhere)
										->where($where)
										->limit($limit)
										->field(\$hisiListField)
										->orderRaw('$order')
										->select();

				}

				\$$index = 0;

				foreach(\$hisiList as \$$key => &$$id):
					if (stripos(\${$id}['url'], 'http') === false) {
						\${$id}['url'] = url(\${$id}->hasCategory['url'].'/'.\${$id}['url']);
					}
					
					++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach; endif;?>';

    	return $parseStr;

    }

    /* 表单数据列 */
    public function tagFormdata($tag, $content)
    {
        $name 		= isset($tag['name']) ? parse_name($tag['name'], 1) : '';
        $order 		= isset($tag['orderby']) ? $tag['orderby'] : 'id desc';
    	$cache  	= isset($tag['cache']) ? $tag['cache'] : 'false';
    	$where 		= isset($tag['where']) ? $tag['where'] : '[]';
    	$limit  	= isset($tag['limit']) ? $tag['limit'] : 20;
    	$pagesize	= isset($tag['pagesize']) ? $tag['pagesize'] : 0;
        $id         = isset($tag['id']) ? $tag['id'] : 'r';
        $key        = isset($tag['key']) ? $tag['key'] : 'key';
        $index      = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php

			\$hisiFormDataModel = new \app\cms\model\CmsForm$name;
			
			if ($pagesize > 0) {

				\$pageConfig = [];

				\$hisiFormData = \$hisiFormDataModel
									->cache($cache)
									->where($where)
									->order('$order')
									->paginate($pagesize, false, \$pageConfig);

				\$pages = \$hisiFormData->render();

			} else {

				\$hisiFormData = \$hisiFormDataModel
									->cache($cache)
									->where($where)
									->limit($limit)
									->order('$order')
									->select();

			}
			
			\$$index = 0;

			foreach(\$hisiFormData as \$$key => $$id):

				++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;

    }

    /* 当前位置 */
    public function tagPosition($tag)
    {
    	$cid  	= isset($tag['cid']) ? $tag['cid'] : 0;
        $title 	= isset($tag['title']) ? $tag['title'] : '""';
        $url    = isset($tag['url']) ? $tag['url'] : '""';
        $sep 	= isset($tag['sep']) ? $tag['sep'] : ' > ';

    	$parseStr = <<<INFO
		<?php
		
		\$hisiPositionTitle = $title;
		\$hisiPositionUrl = $url;

		\$hisiCategoryModel = new \app\cms\model\CmsCategory;

		\$hisiPositionArr = \$hisiCategoryModel::getParents($cid);
		
		\$hisiPositionStr = '';

		foreach(\$hisiPositionArr as \$k => \$v) {
			
			if (\$k > 0) {
				\$hisiPositionStr .= '$sep';
			}

			\$hisiPositionStr .= '<a href="'.url('/cms/'.\$v['url']).'">'.\$v['name'].'</a>';

		}

		if (\$hisiPositionTitle && \$hisiPositionUrl) {
			\$hisiPositionStr .= '$sep<a href="'.url('/cms/'.\$hisiPositionUrl).'">'.\$hisiPositionTitle.'</a>';
		}

		echo \$hisiPositionStr;
?>
INFO;

    	return $parseStr;

    }


    /* 导航 */
    public function tagNav($tag, $content)
    {
    	$group  = isset($tag['group']) ? $tag['group'] : '';
    	$cache  = isset($tag['cache']) ? $tag['cache'] : 'false';
        $id     = isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php

			\$hisiNavModel = new \app\cms\model\CmsNav;
			
			\$hisiNav = \$hisiNavModel->tagGetList($cache, '$group');
			
			\$$index = 0;

			foreach(\$hisiNav as \$$key => $$id):

				++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;

    }

    /* 栏目类型 */
    public function tagType($tag, $content)
    {
    	$tid 	= isset($tag['tid']) ? $tag['tid'] : 0;
        $id     = isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php

			if ($tid <= 0) {
				echo '缺少tid参数';
			}

			\$hisiAttrItemModel = new \app\cms\model\CmsAttributeItem;
			
			\$hisiType = \$hisiAttrItemModel::with('hasValues')->where('type_id', $tid)
								->where('search', 1)
								->order('sort asc')
								->field('id,name,form_type,type_id')
								->select();
			
			\$$index = 0;

			foreach(\$hisiType as \$$key => $$id):

				\${$id}['values'] = [];

				if (\${$id}->hasValues) {
					\${$id}['values'] = \${$id}->hasValues->toArray();
				}

				++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;
    }

    /* 栏目 */
    public function tagCategory($tag, $content)
    {

    	$cid 	= isset($tag['cid']) ? $tag['cid'] : 0;
    	$mid 	= isset($tag['mid']) ? $tag['mid'] : 0;
    	$alias 	= isset($tag['alias']) ? $tag['alias'] : '';
        $level  = isset($tag['level']) ? $tag['level'] : 0;
		$field  = isset($tag['field']) ? $tag['field'] : '';
        $id     = isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php

			\$hisiCategoryCid = $cid;
			\$hisiCatModel = new \app\cms\model\CmsCategory;
			
			if (!empty('$alias')) {

				\$hisiCategoryCid = (int)\$hisiCatModel->where('alias', '$alias')->value('id');

			}
			
			\$hisiCategory = \$hisiCatModel->tagGetChilds(\$hisiCategoryCid, $level, $mid, '$field');
			
			\$$index = 0;

			foreach(\$hisiCategory as \$$key => $$id):

				++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;

    }

    /* 表单 */
    public function tagForm($tag, $content)
    {

        $name   = isset($tag['name']) ? $tag['name'] : '';
    	$fid 	= isset($tag['fid']) ? $tag['fid'] : 0;
    	$cache  = isset($tag['cache']) ? $tag['cache'] : 'false';
        $id     = isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php
		
		if (!empty('$name') || $fid > 0) :

			if ( $fid > 0) {

				\$hisiFormFid = $fid;

			} else {

				\$hisiFormFid = (int)(new \app\cms\model\CmsForm)->where('table_name', '$name')->value('id');

			}
			
			\$hisiFormFields = db('cms_form_field')->where('fid', \$hisiFormFid)->cache($cache)->order('sort asc')->select();
			
			\$$index = 0;

			foreach(\$hisiFormFields as \$key => $$id):
				
				if (in_array(\${$id}['type'], ['checkbox', 'radio', 'select'])) {

					\${$id}['options'] = parse_attr(\${$id}['options']);

					if (\${$id}['type'] == 'checkbox') {

						\${$id}['value'] = parse_attr(\${$id}['value']);

					}

				}

				++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach; else: echo "缺少name属性"; endif;?>';

    	return $parseStr;

    }

    /* 幻灯片 */
    public function tagSlide($tag, $content)
    {

    	$group 	= isset($tag['group']) ? $tag['group'] : '';
    	$type 	= isset($tag['type']) ? $tag['type'] : 'pc';
    	$limit 	= isset($tag['limit']) ? $tag['limit'] : 10;
    	$order  = isset($tag['orderby']) ? $tag['orderby'] : 'sort asc';
        $id     = isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php
		
		\$hisiSlideWhere = [];

		if ('$group') {
			\$hisiSlideWhere[] = ['groups', '=', '$group'];
		}

		if ('$type') {
			\$hisiSlideWhere[] = ['type', '=', '$type'];
		}

		\$hisiSlide = (new \app\cms\model\CmsSlide)->where(\$hisiSlideWhere)->limit($limit)->order('$order')->select();
			
		\$$index = 0;

		foreach(\$hisiSlide as \$$key => $$id):

			++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;

    }

    /* 友情链接 */
    public function tagLink($tag, $content)
    {

    	$group 	= isset($tag['group']) ? $tag['group'] : '';
    	$type 	= isset($tag['type']) ? strtolower($tag['type']) : 'all';
    	$limit 	= isset($tag['limit']) ? $tag['limit'] : 99;
    	$order  = isset($tag['orderby']) ? $tag['orderby'] : 'sort asc';
        $id     = isset($tag['id']) ? $tag['id'] : 'r';
        $key    = isset($tag['key']) ? $tag['key'] : 'key';
        $index  = isset($tag['index']) ? $tag['index'] : 'i';

    	$parseStr = <<<INFO
		<?php
		\$hisiLinkWhere = [];

		if ('$type' == 'image') {

			\$hisiLinkWhere[] = ['image', '<>', ''];

		} else if ('$type' == 'text') {

			\$hisiLinkWhere[] = ['image', '=', ''];

		}

		if ('$group') {

			\$hisiLinkWhere[] = ['groups', '=', '$group'];

		}

		\$hisiLink = (new \app\cms\model\CmsLink)->where(\$hisiLinkWhere)->limit($limit)->order('$order')->select();
			
		\$$index = 0;

		foreach(\$hisiLink as \$$key => $$id):

			++\$$index;
?>
INFO;
		$parseStr .= $content;
		$parseStr .= '<?php endforeach;?>';

    	return $parseStr;

    }

    /* 碎片 */
    public function tagBlock($tag)
    {

    	$name = isset($tag['name']) ? $tag['name'] : '';

    	$parseStr = <<<INFO
		<?php

		\$hisiBlock = (new \app\cms\model\CmsBlock)->where('name', '$name')->find();

		if (\$hisiBlock) {

			if (\$hisiBlock['type'] == 3) {

				\$hisiBlockContent = '<img src="'.\$hisiBlock['content'].'" />';

			} else {

				\$hisiBlockContent = htmlspecialchars_decode(\$hisiBlock['content']);

			}
			
			if (\$hisiBlock['url'] && \$hisiBlock['type'] != 1) {

				\$hisiBlockContent = '<a href="'.\$hisiBlock['url'].'" target="_blank">'.\$hisiBlockContent.'</a>';

			}

			echo \$hisiBlockContent;
		}
?>
INFO;

    	return $parseStr;

    }
}
