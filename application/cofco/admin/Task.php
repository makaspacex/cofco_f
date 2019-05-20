<?php


namespace app\cofco\admin;

use app\cofco\model\AdminPending as PendingModel;

/**终审页面
 * Class finaly
 * @package app\cofco\admin
 */
class Task extends AdminBase
{
    public function index()
    {
        $this->init_searchForm();
        return $this->fetch();
    }
    /***
     *
     * 任务分配 页面
     */
    public function distribution(){
        $this->init_searchForm();
        $this->assign('art_status', '0');
        return $this->fetch();
    }

    /***
     *  任务进度查看页面
     *
     * @return string
     */
    public function progress(){
        $this->init_searchForm();
        $this->assign('art_status', '6');
        return $this->fetch();
    }

    /***
     * 我的任务总览页面
     *
     */

    public function view(){
        $this->init_searchForm();
        $this->assign('art_status', '1');
        return $this->fetch();
    }

    /***
     * 文献初审页面
     */
    public function auditor(){
        $this->init_searchForm();
        $this->assign('art_status', '1');
        return $this->fetch();
    }

    /***
     * 文献标注页面
     */
    public function labelor(){
        $this->init_searchForm();
        $this->assign('art_status', '2');
        return $this->fetch();
    }

    /***
     * 文献终审页面
     */
    public function final_auditor(){
        $this->init_searchForm();
        $this->assign('art_status', '3');
        return $this->fetch();
    }


}