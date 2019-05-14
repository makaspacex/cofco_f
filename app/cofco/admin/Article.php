<?php


namespace app\cofco\admin;

use app\cofco\model\AdminUserlog as LogModel;
use think\Exception;
use \think\Request;
use \think\Db;

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
        $impact_factor = input('param.impact_factor/s');
        $journal_zone = input('param.journal_zone/s');
        $status = input('param.status/s');

        $map = array();


        // 文章标题
        if (!empty($title)) {
            if($title == NULL_STR){
                $map['title'] = [['EXP','IS NULL'],['EQ',""],'or'];
            }else{
                $map['title'] = ['LIKE', '%' . $title . '%'];
            }
        }


        // 爬虫关键词
        if (!empty($kw_id)) {
            if($kw_id == NULL_STR){
                $map['kw_id'] = [['EXP','IS NULL'],['EQ',""],'or'];
            }else{
                $map['kw_id'] = ['EQ', $kw_id];
            }
        }

        // 文章ID
        if (!empty($art_ids)) {
            $map['art_id'] = ['IN', $art_ids];
        }

        // 影响因子
        try{
            if (!empty($impact_factor) && $impact_factor != NULL_STR) {
                $con_arr = explode('-',$impact_factor, 2);
                if(sizeof($con_arr) == 1){
                    array_push($con_arr,$con_arr[0]);
                }
                $con_arr[0] = $con_arr[0] != ''?$con_arr[0]: PHP_FLOAT_MIN;
                $con_arr[1] = $con_arr[1] != ''?$con_arr[1]: PHP_FLOAT_MAX;
                $map['impact_factor'] = ['BETWEEN', $con_arr];
            }else if($impact_factor == NULL_STR){
                $map['impact_factor'] = [['EXP','IS NULL'],['EQ',""],'or'];
            }

        }catch(\Exception $e){
            throw new Exception('影响因子填写格式不正确:'.$e->getMessage());
        }



        // 发表时间筛选
        if (!empty($date_start) && $date_start != NULL_STR) {
            $map['issue'] = ['EGT', $date_start];
        }
        if (!empty($date_end) && $date_end != NULL_STR) {
            $map['issue'] = ['ELT', $date_end];
        }
        if (!empty($date_start) and !empty($date_end) and $date_start != NULL_STR and $date_end != NULL_STR ) {
            $map['issue'] = ['BETWEEN', [$date_start, $date_end]];
        }
        if($date_start == NULL_STR and $date_end == NULL_STR){
            $map['issue'] = [['EXP','IS NULL'],['EQ',""],'or'];
        }

        // 分区处理
        try{
            if (!empty($journal_zone) && $journal_zone != NULL_STR) {
                $con_arr = explode('-',$journal_zone, 2);
                if(sizeof($con_arr) == 1){
                    array_push($con_arr,$con_arr[0]);
                }
                $con_arr[0] = $con_arr[0] != ''?$con_arr[0]: PHP_INT_MIN;
                $con_arr[1] = $con_arr[1] != ''?$con_arr[1]: PHP_INT_MAX;
                $map['journal_zone'] = ['BETWEEN', $con_arr];
            }else if($journal_zone == NULL_STR){
                $map['journal_zone'] = [['EXP','IS NULL'],['EQ',""],'or'];
            }
        }catch(\Exception $e){
            throw new Exception('分区填写格式不正确:'.$e->getMessage());
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
            $sql_str = PendingModel::with(['createUser', 'spiderKw'])->where($where_map)->order($order_by, $ordertype)->buildSql(true);
            return json(['code' => 0, 'message' => '操作完成', 'data' => $res]);

        } catch (\Exception $e) {
            return json(['code' => 1, 'message' => '操作失败:' . $e->getMessage(), 'data' => []]);
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