<?php
//配置文件
use think\Config;

include "app".DS."config.php";
$spider_url = Config::get('spider_url');
/**
 * url 配置文件
 */
return [
    // 获得爬虫状态列表
    'getthreadstatus_url' =>  $spider_url .'getthreadstatus/',

    // 控制爬虫状态（新建、暂停、恢复、终止、删除）
    'controlspider_url' => $spider_url .'controlspider/'
];