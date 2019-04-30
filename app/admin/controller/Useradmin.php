<?php
namespace app\admin\controller;
use app\admin\model\AdminUserlog as LogModel;
use think\Validate;

/**
 * 后台用户、角色控制器
 * @package app\admin\controller
 */
class Useradmin extends Admin
{
    public $tab_data = [];
    /**
     * 初始化方法
     */
    protected function _initialize()
    {
        parent::_initialize();

        $tab_data['menu'] = [
            [
                'title' => '数据统计',
                'url' => 'admin/useradmin/index',
            ],
            [
                'title' => '人员信息管理',
                'url' => 'admin/user/index',
            ],
        ];
        $this->tab_data = $tab_data;
    }

    /**
     * 数据统计
     * @author LiFH
     * @return mixed
     */
    public function index($q = '')
    {
        $uID = $_SESSION['hisiphp_']['admin_user']['uid'];

        $sql = 'select year,month, 
            sum(case when type like 1 then 1 else 0 end) as "create",
            sum(case when type like 2 then 1 else 0 end) as "pre",
            sum(case when type like 3 then 1 else 0 end) as "finaly"
            FROM `hisi_admin_userlog`  
            WHERE uID like '.$uID.'
            group by year,month';
        // $data_list = LogModel::where($sqlmap)->group('year')->group('month')->select();
        $data_list = LogModel::query($sql);
        $this->assign('data_list', $data_list);
        return $this->fetch();
    }

   
}
