<?php


namespace app\cofco\admin;

use app\admin\model\AdminUserlog as LogModel;
use \think\Request;

use app\cofco\model\AdminPending as PendingModel;

class Article extends AdminBase
{
    public static function getSearchMap()
    {
        $title = input('param.title/s');
        $kw_id = input('param.kw_id/s');
        $art_ids = input('param.art_id/a');
        $date_start = input('param.date_start/s');
        $date_end = input('param.date_end/s');
        $impact_factor_start = input('param.impact_factor_start/s');
        $impact_factor_end = input('param.impact_factor_end/s');
        $journal_zone_start = input('param.journal_zone_start/s');
        $journal_zone_end = input('param.journal_zone_end/s');
        $status = input('param.status/s');

        $map = array();
        if (!empty($title)) {
            $map['title'] = ['LIKE', '%' . $title . '%'];
        }
        if (!empty($kw_id)) {
            $map['kw_id'] = ['EQ', $kw_id];
        }

        if (!empty($art_ids)) {
            $map['art_id'] = ['IN', $art_ids];
        }

        // 影响因子

        if (!empty($impact_factor_start) or $impact_factor_start == '0') {
            $map['impact_factor'] = ['EGT', $impact_factor_start];
        }
        if (!empty($impact_factor_end) or $impact_factor_end == '0') {
            $map['impact_factor'] = ['ELT', $impact_factor_end];
        }
        if ((!empty($impact_factor_start) or $impact_factor_start == '0') and (!empty($impact_factor_end) or $impact_factor_end == '0')) {
            $map['impact_factor'] = ['BETWEEN', [$impact_factor_start, $impact_factor_end]];
        }

        // 发表时间筛选
        if (!empty($date_start)) {
            $map['issue'] = ['EGT', $date_start];
        }
        if (!empty($date_end)) {
            $map['issue'] = ['ELT', $date_end];
        }
        if (!empty($date_start) and !empty($date_end)) {
            $map['issue'] = ['BETWEEN', [$date_start, $date_end]];
        }

        // 分区处理

        if (!empty($journal_zone_start) or $journal_zone_start == '0') {
            $map['journal_zone'] = ['EGT', $journal_zone_start];
        }
        if (!empty($journal_zone_end) or $journal_zone_end == '0') {
            $map['journal_zone'] = ['ELT', $journal_zone_end];
        }
        if ((!empty($journal_zone_start) or $journal_zone_start == '0') and (!empty($journal_zone_end) or $journal_zone_end == '0')) {
            $map['journal_zone'] = ['BETWEEN', [$journal_zone_start, $journal_zone_end]];
        }
        if (!empty($status)) {
            $map['status'] = ['EQ', $status];

        }
        return $map;
    }
    /**获取日志查询条件
     * @param $type 日志类型 *
     * 1文献初审状态  2文献标注状态
     * 3文献终审状态  4文献输出状态
     * @param $id 文章ID
     * @return array
     */
    function insertLog($type,$tid){
        $map = [];
        $map['type'] = $type;
        $map['uID'] = $_SESSION['hisiphp_']['admin_user']['uid'];  //用户ID
        $map['tID'] = $tid;  //文章ID
        $map['ctime'] = time();
        $map['year'] = date('Y');
        $map['month'] = date('m');
        $map['day'] = date('d');
        return LogModel::insert($map);

    }
    /**
     * 文章筛选过滤统一接口
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function search()
    {
        try {
            $where_map = Article::getSearchMap();
            $page_size = input('param.limit/s');
            $order_by = input('param.orderby/s', 'ctime');
            $ordertype = input('param.ordertype/s', 'desc');
            $res = PendingModel::with(['createUser', 'spiderKw'])->where($where_map)->order($order_by, $ordertype)->paginate($page_size, false);
            if ($res)
                return json(['code' => 0, 'message' => '操作完成', 'data' => $res]);

        } catch (\Exception $e) {
            return json(['code' => 0, 'message' => '操作失败' . $e->getMessage(), 'data' => []]);
        }
    }

    /**
     * 单个文章查看接口，返回完整html页面或仅内容页面
     */
    public function view($art_id = 0)
    {

        $row = PendingModel::where('art_id', $art_id)->find()->toArray();
        $this->assign('data_info', $row);
        $this->view->engine->layout(false);
        return $this->afetch('form');
    }

    public function setStatus()
    {
        try {
            $where_map = Article::getSearchMap();
            $status = input('param.status/s'); // 默认状态不改变
            $setstatus = input('param.setstatus/s', $status);
            PendingModel::where($where_map)->update(['status' => $setstatus]);;
            return json(['code' => 0, 'message' => '操作完成']);

        } catch (\Exception $e) {
            return json(['code' => 25, 'message' => '操作失败' . $e->getMessage()]);
        }
    }

    /*
     * 文章删除 一个或多个，或条件删除
     */
    public function del()
    {
        try {
            $where_map = Article::getSearchMap();
            PendingModel::where($where_map)->delete();
            return json(['code' => 0, 'message' => '操作完成']);
        } catch (Exception $e) {
            return json(['code' => 25, 'message' => '操作失败' . $e->getMessage()]);
        }

    }

    /**文章添加
     * @return \think\response\Json
     */
    public function add()
    {
        if ($this->request->isPost()) {

            $data = $this->request->post();

            $data['issue'] = strtotime($data['issue']);
            $data['issue'] = date("Y-m", $data['issue']);
            $data['creater'] = $_SESSION['hisiphp_']['admin_user']['uid'];
            $data['project'] = 'MAN';
            $art_id = $data['art_id'];
            if ($data['status'] == 1) {

                $res = PendingModel::where('art_id',$art_id)->find();
                if($res){
                    return json(['code' => 25, 'message' => '操作失败:该art_id已存在！！！','data' => $res]);
                }

                $res = PendingModel::create($data);
                if (!$res) {
                    return json(['code' => 25, 'message' => '操作失败']);
                }
                // 插入日志 1代表人工输入
                Article::insertLog(1, $art_id);

                return json(['code' => 0, 'message' => '操作成功']);
            }
        }

    }

    /**文章编辑
     * @return \think\response\Json
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            $status = $data['status'];
            $pre_status = $data['pre_status'];
            $art_id = $data['art_id'];
            if((int)$status-1==$pre_status){
                Article::insertLog($pre_status, $art_id);
            }
            else if((int)$status==$pre_status-1){
                $map = [];
                $map['type'] = $status;
                $map['tID'] = $art_id;  //文章ID
                LogModel::where($map)->delete();
            }
            unset($data['pre_status']);
            $res = PendingModel::update($data);
            if (!$res) {
                return json(['code' => 25, 'message' => '操作失败']);
            }
            return json(['code' => 0, 'message' => '操作成功']);
        }
    }
}