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
use app\cms\model\CmsComment as CommentModel;

/**
 * 评论控制器
 * @package app\cms\admin
 */
class Comment extends Admin
{
    protected $hisiModel = 'CmsComment';

    public function index()
    {
        if ($this->request->isAjax()) {

            $page   	= $this->request->param('page/d', 1);
            $limit  	= $this->request->param('limit/d', 20);
            $contentId 	= $this->request->param('content_id/d', 0);
            $userId 	= $this->request->param('user_id/d', 0);
            $ip 		= $this->request->param('ip/s');
            $email 	    = $this->request->param('email/s');

            $where = [];

            if ($contentId) {
            	$where[] = ['content_id', '=', $contentId];
            }

            if ($userId) {
            	$where[] = ['user_id', '=', $userId];
            }

            if ($email) {
            	$where[] = ['email', '=', $email];
            }

            if ($ip) {
            	$where[] = ['ip', '=', $ip];
            }

            $data['data'] 	= CommentModel::with('hasContent')
            					->where($where)
            					->page($page)
            					->limit($limit)
            					->select();

            $data['count'] 	= CommentModel::where($where)->count('id');
            $data['code'] 	= 0;

            return json($data);

        }

        return $this->fetch();
    }
}