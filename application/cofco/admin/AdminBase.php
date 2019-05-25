<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
namespace app\cofco\admin;

use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\system\admin\Admin;
use app\system\model\SystemUser;
use app\cofco\model\AdminKw as KwModel;
use think\db\Where;

/**
 * 后台公共控制器
 * @package app\admin\controller
 */
class AdminBase extends Admin
{
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        define('MODULENAME', 'COFCO');
        define('NULL_STR', 'NULLSTRING!@#!');
        define('THIS_AVG', 'THIS_AVG_FLAG');
        define('SUM_AVG', 'SUM_AVG_FLAG');
        define('MUID1', 'MUID_DKSIKSKS');
        $this->assign('article_api_url', '/cofco/article');
        $this->assign('uid', getCurUser()['uid']);
    }

    /**
     *
     * 获取搜索栏所有的应该获取的信息，包括分类
     */
    public function init_searchForm()
    {
        $all_users = SystemUser::all();
        $this->assign('all_users', $all_users);
        $extra_users_ids =  explode(',',config('task.extra_user_ids'));
        $extrausers = SystemUser::where(new Where(['id'=>['IN',$extra_users_ids]]))->select()->toArray();

        foreach ($extrausers as &$user){
            $user['nick'] = $user['nick'].' [仅指定]';
        }

        $auditor_role_ids = explode(',',config('task.auditor_role_ids'));
        $labelor_role_ids = explode(',',config('task.labelor_role_ids'));
        $final_auditor_role_ids = explode(',',config('task.final_auditor_role_ids'));

        $auditors = SystemUser::where(new Where(['role_id'=>['IN',$auditor_role_ids]]))->select()->toArray();
        $labelors = SystemUser::where(new Where(['role_id'=>['IN',$labelor_role_ids]]))->select()->toArray();
        $final_auditors = SystemUser::where(new Where(['role_id'=>['IN',$final_auditor_role_ids]]))->select()->toArray();

        $auditors = array_merge($auditors,$extrausers);
        $labelors = array_merge($labelors,$extrausers);
        $final_auditors = array_merge($final_auditors,$extrausers);

        $this->assign('auditors', $auditors);
        $this->assign('labelors', $labelors);
        $this->assign('final_auditors', $final_auditors);
        $keyword_list = KwModel::all();
        $this->assign('keyword_list', $keyword_list);
        $label_list = LevellabelModel::where('status', '1')->select();
        $this->assign('label_list', $label_list);
    }
}
