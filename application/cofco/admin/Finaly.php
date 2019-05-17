<?php


namespace app\cofco\admin;

/**终审页面
 * Class finaly
 * @package app\cofco\admin
 */
class Finaly extends AdminBase
{
    public function index()
    {
        $this->init_searchForm();
        $this->assign('art_status', 3);
        return $this->fetch();
    }
}