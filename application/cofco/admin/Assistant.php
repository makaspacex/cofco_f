<?php


namespace app\cofco\admin;

/**终审页面
 * Class finaly
 * @package app\cofco\admin
 */
class Assistant extends AdminBase
{
    public function index()
    {
        $this->init_searchForm();
        $this->assign('art_status', 3);
        return $this->fetch();
    }

    /***
     *
     * 黑名单
     * @return string
     */
    public function blacklist(){
        $this->init_searchForm();
        $this->assign('art_status', -2);
        return $this->fetch();
    }

    /***
     *
     * 已删除列表
     * @return string
     */
    public function deletedlist(){
        $this->init_searchForm();
        $this->assign('art_status', -1);
        return $this->fetch();
    }

    /***
     *
     * 文献输出
     * @return string
     */
    public function output()
    {
        $this->init_searchForm();
        $this->assign('art_status', 4);
        return $this->fetch();
    }

}