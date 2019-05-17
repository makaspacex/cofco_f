<?php

namespace app\cofco\admin;

use app\cofco\model\AdminKw as KwModel;

/**
 * Class Spider
 * 该文件要实现爬虫相关功能如下：
 * 一、新建爬虫
 * 1、选择爬虫关键词词组
 * 2、选择爬虫
 * 3、设定更新频率
 * 二、爬虫状态查看
 * 1、创建时间
 * 2、关键词词组
 * 3、更新频率
 * 4、创建人
 * 5、运行时间
 * 6、进度
 * 三、爬虫关键词管理
 * 1、关键词词组增删改查
 * 2、多个关键词为And关系
 * 3、仅支持默认检索
 *
 * @package app\COFCO\admin
 */
class Spider extends AdminBase
{



    /**主页
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $keyword_list = KwModel::paginate();
        $this->assign('keyword_list', $keyword_list);
        return $this->fetch();
    }

    /**
     * 添加pubmed爬虫任务
     */
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
        return $this->fetch();
    }


    public function control()
    {
        $this->assign('getthreadstatus_url',config('spider.getthreadstatus_url'));
        $this->assign('controlspider_url',config('spider.controlspider_url'));
        return $this->fetch();
    }

}