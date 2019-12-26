<?php

namespace app\cofco\admin;

use app\system\model\SystemUser;
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
        if($this->request->isAjax()){
            $uID = $keyword = input('param.uID/s');
            $field = ['year'
                ,'month'
                ,'sum(case when type like 1 then 1 else 0 end) as "creater"'
                ,'sum(case when type like 2 then 1 else 0 end) as "auditor"'
//                ,'sum(case when type like 12 then 1 else 0 end) as "_auditor"'
                ,'sum(case when type like 3 then 1 else 0 end) as "labelor"'
//                ,'sum(case when type like 13 then 1 else 0 end) as "_labelor"'
                ,'sum(case when type like 4 then 1 else 0 end) as "final_auditor"'];
//                ,'sum(case when type like 14 then 1 else 0 end) as "_final_auditor"'];
            $map = [];
            if($uID){
                $map['uID']=$uID;
            }
            $res = LogModel::Where($map)->field($field)->group('year,month')->select();
            return json(['code' => 0, 'message' => '操作完成', 'data' => $res]);
        }
        $all_users = SystemUser::all();
        $this->assign('all_users',$all_users);
        return $this->fetch();
    }


   
}
