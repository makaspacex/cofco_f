<?php


namespace app\cofco\admin;

use app\admin\model\AdminUserlog as LogModel;
use app\cofco\model\AdminId as IdModel;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;
use think\Config;
include("app".DS."cofco".DS."common".DS."getMap.php");
class Article extends AdminCOFCO
{

    /**
     * 文章筛选过滤统一接口
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function search(){

        $where_map = array();
        $title = input('param.title/s');
        $kw_id = input('param.kw_id/s');
        $date_start = input('param.date_start/s');
        $date_end = input('param.date_end/s');
        $impact_factor_start = input('param.impact_factor_start/s');
        $impact_factor_end = input('param.impact_factor_end/s');
        $journal_zone = input('param.journal_zone/s');
        $status = input('param.status/s');
        $page_size = input('param.limit/s',10);

        if(isset($title)) {
            $where_map['title'] = ['like', '%' . $title . '%'];
        }
        if(isset($kw_id)) {
            $where_map['kw_id']= ['like', '%' . $kw_id . '%'];
        }
        if(isset($impact_factor_end)) {
            $where_map['impact_factor']=['between',[$impact_factor_start,$impact_factor_end]];
        }
        if(isset($date_start)) {
            $date_start = strtotime($date_start);
            $date_end = strtotime($date_end);
            $where_map['ctime']=['between',[$date_start,$date_end]];
        }

        if($journal_zone){
            $where_map['journal_zone']= $journal_zone;
        }

        if(isset($status)){
            $where_map['status']= $status;
        }

        $res = PendingModel::where($where_map)->paginate($page_size, false);
        if ($res)
            return json(['code' => 0, 'message' => '操作完成', 'data' => $res]);
        return json(['code' => 0, 'message' => '操作失败', 'data' => []]);
    }

    /**
     * 单个文章查看接口，返回完整html页面或仅内容页面
     */
    public function view(){


    }


}