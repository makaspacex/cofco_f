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

// ===== ！！！请勿修改此文件，升级时会被覆盖！！！ =====

namespace app\cms\api;

use app\common\controller\Common;
use app\cms\model\CmsContent as ContentModel;
use app\cms\model\CmsSlide as SlideModel;
use app\cms\model\CmsModel as ModelModel;
use app\cms\model\CmsLink as LinkModel;
use app\cms\model\CmsRec as RecModel;
use app\cms\model\CmsNav as NavModel;
use app\cms\model\CmsTag as tagModel;
use app\cms\model\CmsForm as FormModel;
use app\cms\model\CmsCategory as CategoryModel;
use app\cms\model\CmsFormField as FormFieldModel;
use app\cms\model\CmsAttributeIndex as IndexModel;
use app\cms\model\CmsAttributeItem as ItemModel;
use app\cms\model\CmsAttributeValue as ValueModel;
use think\Validate;
use hisi\Dir;

class Base extends Common
{
    public function apiList()
    {

        $cid    = $this->request->param('cid/d', 0);
        $mid    = $this->request->param('mid/d', 0);
        $model  = $this->request->param('model/s', '');
        $order  = $this->request->param('order/s', 'id asc');
        $field  = $this->request->param('field/s');
        $keyword= $this->request->param('keyword/s');
        $tag    = $this->request->param('tag/s');
        $limit  = $this->request->param('limit/d', 10);
        $psize  = $this->request->param('pagesize/d', 0);
        $page   = $this->request->param('page/d', 1);
        $flag   = $this->request->param('flag/s');
        $fields = 'id,cid,mid,extend_id,title,tag,title_color,url,flag,image,views,likes,comments,favs,create_time,update_time,timing';
        $diyTable = '';
        $where = [];
        $where[] = ['status', '=', 1];

        if ($field) {
            $fields .= ','.$field;
        }

        if ($flag) {

            if ($flag == 'all') {

                $where[] = ['flag', '<>', ''];

            } else {

                $where[] = ['flag', 'like', '%'.$flag.'%'];

            }

        }

        if ($psize > 0) {
            $limit = $psize;
        }

        if ($mid > 0) {
            $where[] = ['mid', '=', $mid];
        } else if ($model) {
            $mid = (int)ModelModel::where('name', $model)->value('id');
        }

        if ($keyword) {
            $whre[] = ['title', 'like', '%'.$keyword.'%'];
        }

        if ($tag) {
            $where[] = ['tag', 'like', '%,'.$tag.',%'];
        }

        if ($cid > 0) {

            $cat = CategoryModel::where('id', $cid)->find();

            if (!$cat) {
                return $this->error('分类不存在');
            }

            $where[] = ['cid', 'in', $cat->childs];

            $diyTable = $cat->hasModel['name'];

            if ($cat->type_id > 0) {

                $param = $this->request->except(['cid', 'mid', 'model', 'field', 'tag', 'flag', 'keyword', 'page', 'hot', 'top', 'order', 'limit', 'pagesize']);

                $indexs = IndexModel::lists($param);

                $where[] = ['id', 'in', $indexs];

            }

        } else if ($mid > 0) {

            $diyTable = ModelModel::where('id', $mid)->value('name');

        } else {

            return $this->error('mid、model、cid至少传一个');

        }

        if (!$diyTable) {
            return $this->error('模型不存在');
        }

        $diyTable = config('database.prefix').'cms_diy_'.$diyTable;

        $data = [];
        $data['total'] = 0;
        $data['data'] = [];

        $rows = ContentModel::where($where)
                ->alias('c')
                ->join([$diyTable => 'diy'], 'c.extend_id = diy.eid')
                ->field($fields)
                ->orderRaw($order)
                ->limit($limit)
                ->page($page)
                ->select();

        if ($psize > 0) {
            $data['total'] = ContentModel::where($where)
                            ->alias('c')
                            ->join([$diyTable => 'diy'], 'c.extend_id = diy.eid')
                            ->count('c.id');
        }

        foreach ($rows as $k => $v) {

            if (stripos($v['url'], 'http') === false) {

                $v['url'] = url($v->hasCategory['url'].'/'.$v['url']);

            }

            $data['data'][] = $v;
        }
        
    	return $data;

    }

    public function apiDetail()
    {

        $id = $this->request->param('id');
        
        $content = ContentModel::with(['hasCategory' => function($query) {
                    $query->field('id,type_id');
                }])->where('id', $id)->where('status', 1)->find();

        if (!$content) {
            return '内容不存在';
        }

        $diyContent = $content->getDiyContent($id);
        
        foreach ($diyContent as $k => $v) {
            $content->$k = $v;
        }

        $content->toArray();
        $content['attribute'] = [];

        if ($content['has_category']['type_id'] > 0) {

            $index  = IndexModel::where('content_id', $id)->column('item,value');
            $items  = ItemModel::where('id', 'in', array_keys($index))->column('id,name');
            $values = ValueModel::where('id', 'in', array_values($index))->column('item_id,name');

            foreach ($items as $k => $v) {

                $content['attribute'][] = [
                    'name' => $v,
                    'value'=> isset($values[$k]) ? $values[$k] : '',
                ];

            }

        }

        $content['prev'] = ContentModel::getPrev($id, $content->cid);
        $content['next'] = ContentModel::getNext($id, $content->cid);

        unset($content['has_category']);

        return $content;

    }

    public function apiCategory()
    {

        $cid = $this->request->param('cid/d', 0);
        $mid = $this->request->param('mid/d', 0);
        $level = $this->request->param('level/d', 0);

        return (new CategoryModel)->tagGetChilds($cid, $level, $mid);

    }

    public function apiRec()
    {

    	$name  = $this->request->param('name');
    	$field = $this->request->param('field');
		
		return RecModel::tagGetList($name, $field);
		
    }

    public function apiSlide()
    {

        $group = $this->request->param('group/s');
        $type  = $this->request->param('type/s', 'pc');
        $limit = $this->request->param('limit/d', 10);
        $orderby = $this->request->param('orderby/s', 'id_desc');

        switch(strtolower($orderby)) {
            case 'id_asc':
                $order = 'id asc';
                break;
                
            case 'sort_asc':
                $order = 'sort asc';
                break;
                
            case 'sort_desc':
                $order = 'sort desc';
                break;

            default:
                $order = 'id desc';
                break;
        }

        $where = [];

        if ($group) {
            $where[] = ['group', '=', $group];
        }

        if ($type) {
            $where[] = ['type', '=', $type];
        }

        return SlideModel::where($where)->limit($limit)->order($order)->select();

    }

    public function apiLink()
    {

        $group = $this->request->param('group/s');
        $limit = $this->request->param('limit/d', 99);
        $orderby = $this->request->param('orderby/s', 'id_desc');

        switch(strtolower($orderby)) {
            case 'id_asc':
                $order = 'id asc';
                break;
                
            case 'sort_asc':
                $order = 'sort asc';
                break;
                
            case 'sort_desc':
                $order = 'sort desc';
                break;

            default:
                $order = 'id desc';
                break;
        }

        $where = [];

        if ($group) {
            $where[] = ['group', '=', $group];
        }

        return LinkModel::where($where)->limit($limit)->order($order)->select();

    }

    public function apiNav()
    {

        $group = $this->request->param('group/s');

        return (new NavModel)->tagGetList(false, $group);

    }

    public function apiTag()
    {

        $limit = $this->request->param('limit/d', 10);

        return tagModel::limit($limit)->order('search_count desc')->select();

    }

    public function apiForm()
    {

        $name = $this->request->param('name/s');
        $fid = $this->request->param('fid/d', 0);

        if ($name) {
            $fid = FormModel::where('table_name', $name)->value('id');
        }
        
        if (!$fid) {
            return '表单不存在';
        }

        $fields = FormFieldModel::where('fid', $fid)->order('sort asc')->select();

        foreach($fields as &$v) {
            
            if (in_array($v['type'], ['checkbox', 'radio', 'select'])) {

                $v['options'] = parse_attr($v['options']);

                if ($v['type'] == 'checkbox') {

                    $v['value'] = parse_attr($v['value']);

                }

            }
        }

        return $fields;

    }

    public function apiType()
    {

        $id = $this->request->param('tid/d', 0);

        $data = ItemModel::with('hasValues')->where('type_id', $id)
                ->where('search', 1)
                ->order('sort asc')
                ->field('id,name,form_type,type_id')
                ->select();

        foreach($data as &$v) {

            $v['values'] = [];

            if ($v->hasValues) {
                $v['values'] = $v->hasValues->toArray();
            }
        }

        return $data;

    }

    public function apiUpload()
    {
        $file   = $this->request->file('file');
        $fid    = $this->request->param('fid/d', 0);
        $field  = $this->request->param('field/s', '');

        $row = FormFieldModel::where('fid', $fid)->where('name', $field)->find();
        if (!$row) {
            return '禁止上传';
        }

        if ($row->type != 'image' && $row->type != 'file') {
           return '禁止上传'; 
        }

        $rule = [];
        $rule[$row['name'].'|'.$row['title']] = $row['rule'];

        $data = [];
        $data[$row['name']] = $file;

        $validate = new Validate($rule);
        if (!$validate->check($data)) {
            return $validate->getError();
        }

        $path = '/upload/form/';

        if (!is_dir($path)) {
            Dir::create($path);
        }

        $info = $file->rule('md5')->move('.'.$path);
        if (!$info) {
            return $file->getError();
        }

        $filePath   = $path.$info->getSaveName();
        $domain     = get_domain();

        return ['file' => $filePath, 'domain' => $domain, 'url' => $domain.$filePath];

    }

    public function apiFormSave()
    {

        if (!$this->request->isPost()) {
            return '请使用POST方式提交';
        }

        $userId     = 0;
        $ip         = $this->request->ip();
        $name       = $this->request->param('name/s');
        $fid        = $this->request->param('fid/d', 0);
        $postData   = $this->request->except(['fid', 'name', 'sign', 'timestamp']);

        if ($name) {
            $form = FormModel::where('table_name', $name)->find();
        } else {
            $form = FormModel::where('id', $fid)->find();
        }
        
        if (!$form) {
            return '表单不存在';
        }
        
        try {
        
            $login = model('user/User')->isLogin();

            if ($login) {
                $userId = $login['id'];
            } else if ($form->need_login === 1) {
                return '请登录后提交';
            }

        } catch (\Exception $e) {

            if ($form->need_login === 1) {
                return '请安装user模块';
            }

        }

        try {

            $model = model('cms/CmsForm'.parse_name($form->table_name, 1));

        } catch (\Exception $e) {

            return $e->getMessage();

        }

        $onlyWhere              = [];
        $onlyWhere['user_id']   = $userId;
        $onlyWhere['fid']       = $form->id;
        $onlyWhere['ip']        = $ip;

        if ($model->where($onlyWhere)->find()) {
            return '请勿重复提交';
        }

        $fields = FormFieldModel::where('fid', $form->id)->order('sort asc')->select();

        $newRule = [];

        foreach ($fields as $k => $v) {

            if (!isset($postData[$v['name']])) {
                return '字段['.$v['name'].']不存在';
            }
            
            if ( ($v['type'] == 'file' || $v['type'] == 'image') && file_exists('.'.$postData[$v['name']])) {
                continue;
            }

            $rule = htmlspecialchars_decode($v['rule']);

            if (!empty($rule)) {
                $newRule[$v['name'].'|'.$v['title']] = $rule;
            }

        }
        
        $validate = new Validate($newRule);
        if (!$validate->check($postData)) {
            return $validate->getError();
        }


        $postData['user_id']    = $userId;
        $postData['ip']         = $ip;
        $postData['fid']        = $form->id;
        $postData['user_agent'] = $this->request->server('HTTP_USER_AGENT');

        $result = $model->save($postData);

        if (!$result) {
            return '保存失败';
        }

        $postData['id'] = $model->id;

        runhook('cms_form_save', $postData);

        return $postData;

    }

    public function apiCommentSave()
    {

        if (!$this->request->isPost()) {
            return '请使用POST方式提交';
        }

        $userId     = 0;
        $ip         = $this->request->ip();
        $contentId  = $this->request->param('content_id/d', 0);
        $parentId   = $this->request->param('parent_id/d', 0);
        $page       = $this->request->param('page/s');
        $nick       = $this->request->param('nick/s');
        $email      = $this->request->param('email/s');
        $url        = $this->request->param('url/s');
        $content    = $this->request->param('content/s');
        $extend     = $this->request->param('extend/a');
        // TODO
    }

}
