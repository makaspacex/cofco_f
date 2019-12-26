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
use app\cms\model\CmsForm as FormModel;
use app\cms\model\CmsFormField as FieldModel;

/**
 * 表单内容控制器
 * @package app\cms\admin
 */
class FormContent extends Admin
{
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();

        $this->formId   = $this->request->param('fid');
        $this->formInfo = FormModel::where('id', $this->formId)->find();
        
        if (!$this->formInfo) {
            return $this->error('表单不存在');
        }

        $this->hisiModel    = parse_name('cms_form_'.$this->formInfo->table_name, 1);
        $this->formModel    = model('cms/'.$this->hisiModel);
    }

    /**
     * 表单管理
     * @date   2019-01-09
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAjax()) {

            $page   = $this->request->param('page/d', 1);
            $limit  = $this->request->param('limit/d', 20);

            $data['data'] = $this->formModel->page($page)->limit($limit)->select();
            $data['count'] = $this->formModel->count('id');
            $data['code'] = 0;
            return json($data);

        }

        $assign = [];
        $assign['formInfo'] = $this->formInfo;
        $assign['tableField'] = [];

        // 获取列表显示字段
        $formField = $this->formInfo->hasFormFields()->where('list_show', 1)->order('sort asc')->select();

        if ($formField) {

            foreach ($formField as $k => $v) {

                $arr = [
                    'field' => $v['name'],
                    'title' => $v['title'],
                ]; 

                if (in_array($v['type'], ['radio', 'checkbox', 'select'])) {

                    $options = parse_attr($v['options']);
                    
                    $arr['templet'] = 'function(d) {var arr = '.json_encode($options, 1).';return arr[d.'.$v['name'].'];}';

                } else if ($v['type'] === 'image') {

                    $arr['templet'] = 'function(d) {if (!d.'.$v['name'].') return \'---\';return \'<img class="hisi-img-item" src="\'+d.'.$v['name'].'+\'" title="预览" width="30">\';}';

                } else if ($v['type'] === 'file') {

                    $arr['templet'] = 'function(d) {if (!d.'.$v['name'].') return \'---\';return \'<a href="\'+d.'.$v['name'].'+\'" target="_blank">点此下载</a>\';}';

                }

                $assign['tableField'][] = $arr;
            }

        }

        $this->assign($assign);

        return $this->fetch();
    }

    /**
     * 显示表单内容
     * @date   2019-01-09
     * @access public
     * @author 橘子俊 364666827@qq.com
     * @return json
     */
    public function show($id = 0)
    {

        $assign['formData'] = $this->formModel->where('id', $id)->find();
        
        $this->assign($assign);

        return $this->fetch();
    }
}