<?php

use app\system\model\SystemMenu as MenuModel;
use app\system\model\SystemRole as RoleModel;

/**
 * 获取当前登录的用户
 */
function getCurUser()
{

    return session('admin_user');
}

/***
 * 判断用户对URL是否有权限
 * @param $url
 * @return bool
 */
function is_auth($url)
{

    $curMenu = MenuModel::get(['url' => $url])->toArray();
    if (!empty($curMenu)) {
        if (!$curMenu['status']) {
            return false;
        }
        if (!RoleModel::checkAuth($curMenu['id']) &&
            $curMenu['url'] != 'system/index/index') {
            return false;
        }
    } else if (config('sys.admin_whitelist_verify')) {
        return false;
    }
    return true;
}

/***
 *
 * 返回article相应的值
 */
function artFiledValue($art_arr, $field_name)
{
    if(empty($art_arr) || !array_key_exists($field_name, $art_arr)){
        return "";
    }
    return $art_arr[$field_name];
}