<?php


namespace app\cofco\admin;

use app\cofco\model\AdminPending as PendingModel;
class Article extends AdminCOFCO
{
    public function getSearchMap(){
        $title = input('param.title/s');
        $kw_id = input('param.$kw_id/s');
        $date_start = input('param.date_start/s');
        $date_end = input('param.date_end/s');
        $impact_factor_start = input('param.impact_factor_start/s');
        $impact_factor_end = input('param.impact_factor_end/s');
        $journal_zone_start = input('param.journal_zone_start/s');
        $journal_zone_end = input('param.journal_zone_end/s');
        $status = input('param.status/s');
        $map = array();
        if(!empty($title)) {
            $map['title'] = ['LIKE', '%' . $title . '%'];
        }
        if(!empty($kw_id)) {
            $map['kw_id']= ['EQ', $kw_id ];
        }

        if(!empty($impact_factor_start)){
            $map['impact_factor'] = ['EGT',$impact_factor_start];
        }

        if(!empty($impact_factor_end)) {
            $map['impact_factor']= ['ELT',$impact_factor_start];
        }

        if(!empty($date_start)){
            $map['issue']=['EGT',$date_start];
        }
        if(!empty($date_end)){
            $map['issue']=['ELT',$date_end];
        }
        if(!empty($journal_zone_start)) {
            $map['journal_zone']= ['EGT',$journal_zone_start];
        }
        if(!empty($journal_zone_end)) {
            $map['journal_zone']= ['ELT',$journal_zone_end];
        }

        if(!empty($status)){
            $map['status']= ['eq', $status ];
        }
        return $map;
    }

    /**
     * 文章筛选过滤统一接口
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function search(){

        $where_map = $this->getSearchMap();
        $page_size = input('param.limit/s');
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