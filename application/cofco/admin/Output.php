<?php


namespace app\cofco\admin;


use app\system\model\SystemLog as LogModel;
use app\cofco\model\AdminId as IdModel;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;
use think\Config;

/** 输出页面
 * Class Prepending
 * @package app\cofco\admin
 */
class Output extends AdminBase
{
    public function index()
    {
        $this->init_searchForm();
        $this->assign('art_status', 4);
        return $this->fetch();
    }

}