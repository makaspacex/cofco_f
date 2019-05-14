<?php

namespace app\cofco\admin;

use app\cofco\model\AdminUserlog as LogModel;

/**
 * 后台用户、角色控制器
 * @package app\admin\controller
 */
class Useradmin extends AdminBase
{
    /**
     * 数据统计
     * @author LiFH
     * @return mixed
     */
    public function index()
    {
        $uID = $_SESSION['hisiphp_']['admin_user']['uid'];
        $sql = 'select year,month, 
            sum(case when type like 1 then 1 else 0 end) as "create",
            sum(case when type like 2 then 1 else 0 end) as "pre",
            sum(case when type like 3 then 1 else 0 end) as "finaly"
            FROM `cofco_admin_userlog`  
            WHERE uID like '.$uID.'
            group by year,month';
        $data_list = LogModel::query($sql);
        $this->assign('data_list', $data_list);
        return $this->fetch();
    }

   
}
