<?php
namespace app\cofco\admin;
use app\admin\controller\Admin;


/**
 * Class Spider

 该文件要实现人工输入功能如下：
    一、手动输入页面
        1、标题[必填]
        2、DOI[必填]
        3、摘要[必填]
        4、中文翻译[可选]
        5、标签选择[必填]
    二、半自动输入页面
        方式1：输入URL->爬取结果显示[可编辑，包含文献基本信息]，选择标签[必填]，中文翻译[可选]->入库
        方式2：输入关键词->结果显示，可选择：进入待审核数据库或进入黑名单或点击其中一篇按照方式1编辑入库

 *
 *
 *
 *
 *
 *
 * @package app\COFCO\admin
 */

class LabelData extends Admin
{
    /*
     * 人工输入说明
     * */
    public function index()
    {
        $welcome_html = config('labeldata.label_welcome_info');
        $this->assign('welcome_html',$welcome_html);
        return $this->afetch();
    }

    /**
     * 标签列表
     * @return string
     */
    public function label_list()
    {
        return $this->afetch();
    }

    /**
     * 新建爬虫页面
     * @return string
     */
    public function spider_add()
    {
        return $this->afetch('spider_form');
    }

    /**
     * 编辑爬虫页面
     * @return string
     */
    public function spider_edit()
    {
        return $this->afetch('spider_form');
    }

    /**
     * 爬虫状态查看页面，建议使用web_socket技术
     * @return string
     */
    public function spider_status(){

        return $this->afetch();
    }

    /**
     * 爬虫关键词列表页面
     * @return string
     */
    public function keywords_list(){

        return $this->afetch();
    }

    /**
     * 新建关键词词组
     * @return string
     */
    public function keywords_add(){

        return $this->afetch('keywords_form');
    }

    /**
     * 编辑关键词词组
     * @return string
     */
    public function keywords_edit(){

        return $this->afetch('keywords_form');
    }

    /**
     * 删除关键词词组
     * @return string
     */
    public function keywords_del(){

        return $this->afetch();
    }


}