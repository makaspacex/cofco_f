<?php


namespace app\cofco\admin;

use app\cofco\model\AdminUserlog as LogModel;
use think\Exception;
use \think\Request;
use \think\Db;

use app\cofco\model\AdminPending as PendingModel;

class Article extends AdminBase
{


    private static function _valid($value){
        return !empty($value) && $value != NULL_STR;
    }

    private static function _get_null_contion(){
        return [['EXP','IS NULL'],['EQ',""],'or'];
    }

    private static function _assignLikeCondition(&$map, $field_name, $value){
        if (!empty($value)) {
            if($value == NULL_STR){
                $map[$field_name] = [['EXP','IS NULL'],['EQ',""],'or'];
            }else{
                $map[$field_name] = ['LIKE', '%' . $value . '%'];
            }
        }
    }

    private static function _assignEqCondition(&$map, $field_name, $value){

        if (!empty($value)) {
            if($value == NULL_STR){
                $map[$field_name] = [['EXP','IS NULL'],['EQ',""],'or'];
            }else{
                $map[$field_name] = ['EQ', $value];
            }
        }
    }

    /**
     * 根据Request的数据，生成whereMap，用于查询条件筛选
     *
     * @return array
     * @throws Exception
     */
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
        $doi = input('param.doi/s');
        $creater = input('param.creater/s');
        $auditor = input('param.auditor/s');
        $labelor = input('param.labelor/s');
        $final_auditor = input('param.final_auditor/s');
        $abstract = input('param.abstract/s');
        $tabstract = input('param.tabstract/s');
        $keyword = input('param.keyword/s');
        $project = input('param.project/s');
        $country = input('param.country/s');
        $author = input('param.author/s');
        $institue = input('param.institue/s');
        $journal = input('param.journal/s');
        $issn = input('param.issn/s');
        $urgency = input('param.urgency/s');
        $special_version = input('param.special_version/s');


        $map = array();
        $null_condition = [['EXP','IS NULL'],['EQ',""],'or'];

        // 文章标题
        Article::_assignLikeCondition($map,'title', $title);

        // 爬虫关键词
        Article::_assignEqCondition($map,'kw_id', $kw_id);


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
                $map['impact_factor'] = $null_condition;
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
            $map['issue'] = $null_condition;
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
                $map['journal_zone'] = $null_condition;
            }
        }catch(\Exception $e){
            throw new Exception('分区填写格式不正确:'.$e->getMessage());
        }

        // issn ISSN
        self::_assignLikeCondition($map,'issnl|issne|issnp', $issn);

        // status 状态
        self::_assignEqCondition($map,'status', $status);

        // doi doi
        self::_assignLikeCondition($map,'doi', $doi);


        // creater 创建人
        self::_assignEqCondition($map,'creater', $creater);


        // auditor 初审人
        self::_assignEqCondition($map,'auditor', $auditor);

        // labelor 标注人
        self::_assignEqCondition($map,'labelor', $labelor);
        
        // final_auditor 终审人
        self::_assignEqCondition($map,'final_auditor', $final_auditor);

        
        // abstract 原文摘要
        self::_assignLikeCondition($map,'abstract', $abstract);


        // tabstract 翻译摘要
        self::_assignLikeCondition($map,'tabstract', $tabstract);


        // keyword 关键词
        self::_assignLikeCondition($map,'keyword', $keyword);


        // project 文档类型
        self::_assignEqCondition($map,'project', $project);


        // country 国家
        self::_assignLikeCondition($map,'country', $country);


        // author 文献作者
        self::_assignLikeCondition($map,'author', $author);

        // institue 发表机构
        self::_assignLikeCondition($map,'institue', $institue);


        // journal 发表期刊
        self::_assignLikeCondition($map,'journal', $journal);


        // urgency 紧要程度
        self::_assignLikeCondition($map,'urgency', $urgency);


        // special_version 特别说明
        self::_assignLikeCondition($map,'special_version', $special_version);

        return $map;
    }
    /**获取日志查询条件
     * @param $type 日志类型 *
     * 1.创建文献 2.初审文献
     * 3.标注文献 4.终审文献
     * @param $id 文章ID
     * @return array
     */
    function insertLog($type,$tid){
        $map = [];
        $map['type'] = $type;
        $map['uID'] = $_SESSION['hisiphp_']['admin_user']['uid'];  //用户ID
        $map['tID'] =  $tid;  //文章ID
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


    /**改变status状态
     * @return \think\response\Json
     */
    public function setStatus()
    {
        try {
            $where_map = Article::getSearchMap();
            $status = input('param.status/s'); // 默认状态不改变
            $setstatus = input('param.setstatus/s', $status);
            $art_ids = input('param.art_id/a');
            PendingModel::where($where_map)->update(['status' => $setstatus]);;
            foreach ($art_ids as $art_id){
                Article::insertLog($setstatus, $art_id);
            }

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
                Article::insertLog($status, $art_id);
            }
            else if((int)$status==$pre_status-1){
                $map = [];
                $map['type'] = $pre_status;
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