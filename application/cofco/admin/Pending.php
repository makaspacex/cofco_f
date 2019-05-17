<?php


namespace app\cofco\admin;

/**审核及标注页面
 * Class pending
 * @package app\cofco\admin
 */

class pending extends AdminBase
{
    /**主页
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->init_searchForm();
        $this->assign('art_status', 2);
        return $this->fetch();
    }

}