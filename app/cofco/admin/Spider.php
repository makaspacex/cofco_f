<?php
namespace app\cofco\admin;
use app\admin\controller\Admin;


/**
 * Class Spider
 该文件要实现爬虫相关功能如下：
    一、新建爬虫
        1、选择爬虫关键词词组
        2、选择爬虫
        3、设定更新频率
    二、爬虫状态查看
        1、创建时间
        2、关键词词组
        3、更新频率
        4、创建人
        5、运行时间
        6、进度
    三、爬虫关键词管理
        1、关键词词组增删改查
        2、多个关键词为And关系
        3、仅支持默认检索
 *
 * @package app\COFCO\admin
 */
class Spider extends Admin
{
    /*
     * 该方法要返回
     * */
    public function index()
    {
        $welcome_html = config('spider.spider_welcome_info');
        $this->assign('welcome_html',$welcome_html);
        return $this->afetch();
    }

    /** 创建爬虫页面
     * @return string
     */
    public function create()
    {

        return $this->afetch();
    }

    /**
     * 编辑爬虫页面
     * @return string
     */
    public function edit()
    {
        return $this->afetch();
    }

    /**
     * 爬虫状态查看页面，建议使用web_socket技术
     * @return string
     */
    public function status(){

        return $this->afetch();
    }

    /**
     * 爬虫关键词列表页面
     * @return string
     */
    public function keywordslist(){

        return $this->afetch();
    }

    /**
     * 新建关键词词组
     * @return string
     */
    public function create_keywords(){

        return $this->afetch();
    }

    /**
     * 编辑关键词词组
     * @return string
     */
    public function edit_keywords(){

        return $this->afetch();
    }

}