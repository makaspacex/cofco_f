<?php

namespace app\cofco\admin;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminPending as PendingModel;
use app\cofco\model\AdminSpiderTask as SpiderTaskModel;
use app\admin\controller\Admin;
use think\Config;
use think\Exception;


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
class Spider extends Admin
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
        $pubmed_keyword_list = KwModel::where("type","0")->select();
        $science_keyword_list = KwModel::where("type","1")->select();
        $uid = $_SESSION['hisiphp_']['admin_user']['uid'];
        $uname = $_SESSION['hisiphp_']['admin_user']['nick'];
        $this->assign('uid',$uid);
        $this->assign('uname',$uname);
        $this->assign('controlspider_url',Config::get('controlspider_url'));
        $this->assign('pubmed_keyword_list', $pubmed_keyword_list);
        $this->assign('science_keyword_list', $science_keyword_list);
        return $this->fetch();
    }


    public function control()
    {
        $this->assign('getthreadstatus_url',Config::get('getthreadstatus_url'));
        $this->assign('controlspider_url',Config::get('controlspider_url'));
        return $this->fetch();
    }


    /**
     * 新建与编辑爬虫页面
     * @return string
     */
    public function spider_list()
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
    public function spider_status()
    {

        return $this->afetch();
    }



    /**
     * 编辑关键词词组
     * @return string
     */
    public function keywords_edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (!KwModel::update($data)) {
                return $this->error('修改失败！');
            }
            // 更新缓存
            //cache('system_member_level', KwModel::getAll());
            return $this->success('修改成功。','keywords_list');
        }
        $row = KwModel::where('id', $id)->find()->toArray();
        $this->assign('data_info', $row);
        return $this->afetch('keywords_form');
    }

    /**
     * 删除关键词词组
     * @return string
     */
    public function keywords_del($id=0)
    {
        $ids   = input('param.ids/a');
        $map['id'] = ['in', $ids];
        $map = [];
        $map['id'] = ['in', $ids];
        $res = KwModel::where($map)->delete();
        if ($res === false) {
            return $this->error('操作失败！');
        }
        return $this->success('操作成功！');
    }


//    public function task_list()
//    {
//        $data_list = SpiderTaskModel::paginate();
//
//        // 分页
//        $pages = $data_list->render();
//        $this->assign('data_list', $data_list);
//        $this->assign('pages', $pages);
////        var_dump($data_list);
//        return $this->fetch();
//    }



//    public function task_add()
//    {
//        if ($this->request->isPost()) {
//            $data = $this->request->post();
//            // 验证
//            $result = $this->validate($data, 'AdminMember');
//            if($result !== true) {
//                return $this->error($result);
//            }
//            unset($data['id']);
//            if (!SpiderTaskModel::create($data)) {
//                return $this->error('添加失败！');
//            }
//            return $this->success('添加成功。');
//        }
//        $this->assign('kw_option', KwModel::getOption());
//        return $this->afetch('task_form');
//    }


//    public function task_edit($id = 0)
//    {
//        if ($this->request->isPost()) {
//            $data = $this->request->post();
//            if (!SpiderTaskModel::update($data)) {
//                return $this->error('修改失败！');
//            }
//            // 更新缓存
//            //cache('system_member_level', KwModel::getAll());
//            return $this->success('修改成功。','task_list');
//        }
//        $row = SpiderTaskModel::where('id', $id)->find()->toArray();
//        $this->assign('kw_option', KwModel::getOption());
//        $this->assign('data_info', $row);
//        return $this->afetch('task_form');
//    }
////    public function setfreq($id = 0)
////    {
////        if ($this->request->isPost()) {
////            $data = $this->request->post();
////            $row=$data;
////            //$row=$data;
////            //var_dump($row);
////            //$url = "http://39.108.188.10:9001/spider/add";
////            //$url = "http://10.2.148.107:8000/spider/add";
////            $url = "http://10.2.145.166:8000/spider/add";
////            $ch = curl_init();
////            curl_setopt($ch, CURLOPT_URL, $url);
////            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
////            curl_setopt($ch, CURLOPT_POST, 1);
////            curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
////            if($output = curl_exec($ch)){
////                curl_close($ch);
////                $data_list = json_decode($output,true);
////                if($data_list['status']==0)
////                    return $this->error($data_list['msg']);
////                else
////                    return $this->success('添加成功！','task_list1');
////            }
////            return $this->error('添加失败');
////        }
//        //$this->assign('data_info', $row);
//        return $this->afetch('task_form');
//    }

//    public function task_del()
//    {
//        $ids   = input('param.ids/a');
//        $map = [];
//        $map['id'] = ['in', $ids];
//        $res = SpiderTaskModel::where($map)->delete();
//        if ($res === false) {
//            return $this->error('操作失败！');
//        }
//        return $this->success('操作成功！');
//    }



}