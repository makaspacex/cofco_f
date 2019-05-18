<?php

namespace app\cofco\admin;

use app\cofco\model\AdminUserlog as LogModel;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminPending as PendingModel;
use think\Config;
use think\Exception;

//include("app" . DS . "cofco" . DS . "common" . DS . "getMap.php");
//include("app" . DS . "cofco" . DS . "config.php");


class upload extends AdminBase
{
    protected function initialize()
    {
        parent::initialize();
        $tab_data['menu'] = [
            [
                'title' => '辅助输入',
                'url' => 'cofco/upload/assist',
            ],
            [
                'title' => '人工输入',
                'url' => 'cofco/upload/manual',
            ],
            [
                'title' => '爬虫输入',
                'url' => 'cofco/upload/spider',
            ],
        ];
        $this->assign('hisiTabType', 3);
        $this->tab_data = $tab_data;
    }

    /** 辅助输入
     * @return string|void
     */
    public function assist()
    {

        $tab_data['current'] = url('');
        $this->assign('hisiTabData', $this->tab_data);
        return $this->fetch('pending_fform');
    }

    /** 人工输入
     * @return string|void
     */
    public function manual()
    {
        $tab_data['current'] = url('');
        $this->assign('hisiTabData', $this->tab_data);
        return $this->fetch('form');
    }

    /** 爬虫输入
     * @return mixed
     */
    public function spider()
    {
        $this->assign('getthreadstatus_url',config('spider.getthreadstatus_url'));
        $this->assign('controlspider_url',config('spider.controlspider_url'));
        $tab_data['current'] = url('');
        $this->assign('hisiTabData', $this->tab_data);
        return $this->fetch();
    }

    public function add()
    {
        //定义pubmed查询条件
        $pubmed_map =[];
        $pubmed_map['type'] = 1;
        $pubmed_map['status'] = 1;

        //定义science查询条件
        $science_map = [];
        $science_map['type'] = 2;
        $science_map['status'] =1;

        $pubmed_keyword_list = KwModel::where($pubmed_map)->select();
        $science_keyword_list = KwModel::where($science_map)->select();
        $uid = getCurUser()['uid'];
        $uname = getCurUser()['nick'];
        $this->assign('uid',$uid);
        $this->assign('uname',$uname);
        $this->assign('controlspider_url',config('spider.controlspider_url'));
        $this->assign('pubmed_keyword_list', $pubmed_keyword_list);
        $this->assign('science_keyword_list', $science_keyword_list);
        $this->view->engine->layout(false);
        return $this->fetch();
    }

}