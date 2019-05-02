<?php

use app\cofco\model\AdminPending as PendingModel;

/**获取数据查询条件
     * @param $status
     * 1代表爬虫状态  2代表审核及标注页面状态
     * 3已审核状态  4代表输出状态
     * @return array
     */
    function getDataMap($status){
        $title = input('param.title/s');
        $sstr = input('param.sstr/s');
        $date_start = input('param.date_start/s');
        $date_end = input('param.date_end/s');
        $impact_factor_start = input('param.impact_factor_start/s');
        $impact_factor_end = input('param.impact_factor_end/s');
        $journal_zone = input('param.journal_zone/s');
        $map = array();
        if($title)
        {
            $map['title'] = ['like', '%' . $title . '%'];
        }
        if($sstr)
        {
            $map['sstr']= ['like', '%' . $sstr . '%'];
        }
        if($impact_factor_end)
        {
            $map['impact_factor']=['between',[$impact_factor_start,$impact_factor_end]];
        }
        if($date_start)
        {
            $date_start = strtotime($date_start);
            $date_end = strtotime($date_end);
            $map['ctime']=['between',[$date_start,$date_end]];
        }
        if($journal_zone)
        {
            $map['journal_zone']= $journal_zone;
        }
        $map['status']= $status;

        return $map;
    }

    /**获取日志查询条件
     * @param $type 日志类型 *
     * 1代表爬虫状态  2代表审核及标注页面状态
     * 3已审核状态  4代表输出状态
     * @param $id 文章ID
     * @return array
     */
    function getLogMap($type,$tid){
        $map = [];
        $map['type'] = $type;
        $map['uID'] = $_SESSION['hisiphp_']['admin_user']['uid'];  //用户ID
        $map['tID'] = $tid;  //文章ID
        $map['ctime'] = time();
        $map['year'] = date('Y');
        $map['month'] = date('m');
        $map['day'] = date('d');
        return $map;
    }


