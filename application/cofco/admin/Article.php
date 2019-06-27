<?php


namespace app\cofco\admin;

use app\system\model\SystemUser;
use app\cofco\model\AdminArticleLabel as ArticleLabelModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminUserlog as LogModel;
use think\db\Expression;
use think\db\Where;
use think\Exception;
use think\Db;
use app\cofco\model\AdminPending as PendingModel;


class Article extends AdminBase
{

    /**
     * 初始化方法,  用来记录日志
     */
    protected function initialize()
    {
        parent::initialize();
        $action     = request()->action();
        $art_id =  $this->request->post('art_id');
        if($action==='edit'){
            $pre_status = $this->request->post('pre_status');
            $status = $this->request->post('status');
            if ((int)$status - 1 == $pre_status) {
                LogModel::_insertUserLog($status, $art_id);
            } else if ((int)$status == $pre_status - 1) {
                //这里逻辑还有问题
                $map = [];
                $map['tid'] = $art_id;
                $map['type'] = $status;
//                LogModel::where()->delete();
                //LogModel::_insertUserLog((int)$status+10, $art_id);
            }
        }
        elseif ($action==='add'){
            LogModel::_insertUserLog(1, $art_id);
        }
        elseif ($action==='setStatus'){
            $where_map = Article::getSearchMap();
            $set_status = input('param.set_status/s');
            $art_ids = PendingModel::field('art_id')->where($where_map)->select();
            foreach ($art_ids as $art_id){
                LogModel::_insertUserLog($set_status, $art_id);
            }
        }

    }





    public static function _getNullCondation()
    {

        return [['EXP', new Expression(' is null')], ['=', ""], 'OR'];
    }

    private static function _assignLikeCondition(&$map, $field_name, $value)
    {
        if (!empty($value)|| $value == '0') {
            if ($value == NULL_STR) {
                $map[$field_name] = self::_getNullCondation();

            } else {
                $map[$field_name] = ['LIKE', '%' . $value . '%'];
            }
        }
    }

    private static function _assignEqCondition(&$map, $field_name, $value)
    {

        if (!empty($value)|| $value == '0') {
            if ($value == NULL_STR) {
                $map[$field_name] = self::_getNullCondation();
            } else {
                $map[$field_name] = ['EQ', $value];
            }
        }
    }

    /**
     * 根据Request的数据，生成whereMap，用于查询条件筛选
     *
     * @return Where
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
        $muid = input('param.muid/s');
        $uid = input('param.uid/s');


        $auditor = input('param.auditor/s');
        $labelor = input('param.labelor/s');
        $final_auditor = input('param.final_auditor/s');
        $auditor_finished = input('param.auditor_finished/s');
        $labelor_finished = input('param.labelor_finished/s');
        $final_auditor_finished = input('param.final_auditor_finished/s');

        $map = array();
        $null_condition = Article::_getNullCondation();

        // 文章标题
        Article::_assignLikeCondition($map, 'title', $title);

        // 爬虫关键词
        Article::_assignEqCondition($map, 'kw_id', $kw_id);


        // 文章ID
        if (!empty($art_ids)) {
            $map['art_id'] = ['IN', $art_ids];
        }

        // 影响因子
        try {
            if (!empty($impact_factor) && $impact_factor != NULL_STR) {
                $con_arr = explode('-', $impact_factor, 2);
                if (sizeof($con_arr) == 1) {
                    array_push($con_arr, $con_arr[0]);
                }
                $con_arr[0] = $con_arr[0] != '' ? $con_arr[0] : PHP_FLOAT_MIN;
                $con_arr[1] = $con_arr[1] != '' ? $con_arr[1] : PHP_FLOAT_MAX;
                $map['impact_factor'] = ['BETWEEN', $con_arr];
            } else if ($impact_factor == NULL_STR) {
                $map['impact_factor'] = $null_condition;
            }

        } catch (\Exception $e) {
            throw new Exception('影响因子填写格式不正确:' . $e->getMessage());
        }


        // 发表时间筛选
        if (!empty($date_start) && $date_start != NULL_STR) {
            $map['issue'] = ['EGT', $date_start];
        }
        if (!empty($date_end) && $date_end != NULL_STR) {
            $map['issue'] = ['ELT', $date_end];
        }
        if (!empty($date_start) and !empty($date_end) and $date_start != NULL_STR and $date_end != NULL_STR) {
            $map['issue'] = ['BETWEEN', [$date_start, $date_end]];
        }
        if ($date_start == NULL_STR and $date_end == NULL_STR) {
            $map['issue'] = $null_condition;
        }

        // 分区处理
        try {
            if (!empty($journal_zone) && $journal_zone != NULL_STR) {
                $con_arr = explode('-', $journal_zone, 2);
                if (sizeof($con_arr) == 1) {
                    array_push($con_arr, $con_arr[0]);
                }
                $con_arr[0] = $con_arr[0] != '' ? $con_arr[0] : PHP_INT_MIN;
                $con_arr[1] = $con_arr[1] != '' ? $con_arr[1] : PHP_INT_MAX;
                $map['journal_zone'] = ['BETWEEN', $con_arr];
            } else if ($journal_zone == NULL_STR) {
                $map['journal_zone'] = $null_condition;
            }
        } catch (\Exception $e) {
            throw new Exception('分区填写格式不正确:' . $e->getMessage());
        }

        // issn ISSN
        self::_assignLikeCondition($map, 'issnl|issne|issnp', $issn);

        // status 状态，需要处理虚拟状态位
        if (!empty($status)||$status == '0') {
            if ($status == NULL_STR) {
                $map['status'] = self::_getNullCondation();
            } else if($status == '6'){ //虚拟状态位6，表示状态1，2，3，4
                $map['status'] = ['IN', ['1','2','3','4']];
            }else if($status == '7'){ //虚拟状态位7，表示状态1，2，3
                $map['status'] = ['IN', ['1','2','3']];
            }else{
                $map['status'] = ['EQ', $status];
            }
        }

        // 处理特殊的UID
        if (!empty($muid)|| $muid == '0') {
            if($muid == MUID1 ){ //虚拟UID，表示如果auditor,labelor,final_auditor 要等于提交上来的$uid
                self::_assignEqCondition($map, 'auditor|labelor|final_auditor', $uid);
            }
        }else{
            // auditor 初审人
            self::_assignEqCondition($map, 'auditor', $auditor);

            // labelor 标注人
            self::_assignEqCondition($map, 'labelor', $labelor);

            // final_auditor 终审人
            self::_assignEqCondition($map, 'final_auditor', $final_auditor);
        }

        // doi doi
        self::_assignLikeCondition($map, 'doi', $doi);


        // creater 创建人
        self::_assignEqCondition($map, 'creater', $creater);



        // auditor_finished 初审是否完成
        self::_assignEqCondition($map, 'auditor_finished', $auditor_finished);

        // labelor_finished 标注是否已完成
        self::_assignEqCondition($map, 'labelor_finished', $labelor_finished);

        // final_auditor_finished 终审是否已完成
        self::_assignEqCondition($map, 'final_auditor_finished', $final_auditor_finished);

        // abstract 原文摘要
        self::_assignLikeCondition($map, 'abstract', $abstract);


        // tabstract 翻译摘要
        self::_assignLikeCondition($map, 'tabstract', $tabstract);


        // keyword 关键词
        self::_assignLikeCondition($map, 'keyword', $keyword);


        // project 文档类型
        self::_assignEqCondition($map, 'project', $project);


        // country 国家
        self::_assignLikeCondition($map, 'country', $country);


        // author 文献作者
        self::_assignLikeCondition($map, 'author', $author);

        // institue 发表机构
        self::_assignLikeCondition($map, 'institue', $institue);


        // journal 发表期刊
        self::_assignLikeCondition($map, 'journal', $journal);


        // urgency 紧要程度
        self::_assignLikeCondition($map, 'urgency', $urgency);


        // special_version 特别说明
        self::_assignLikeCondition($map, 'special_version', $special_version);

        return new Where($map);
    }

    private static function _assignData(&$uData, $field_name, $value){
        if($value !== null && $value!= NULL_STR && $value != THIS_AVG && $value != SUM_AVG){
            $uData[$field_name]=$value;
        }
    }

    /***
     *
     * 根据request请求，生成要更新的数组
     */
    public static function getUpdateData(){
        $title = input('param.set_title/s');
        $kw_id = input('param.set_kw_id/s');
        $issue = input('param.set_issue/s');
        $impact_factor = input('param.set_impact_factor/s');
        $journal_zone = input('param.set_journal_zone/s');
        $set_status = input('param.set_status/s');
        $doi = input('param.doi/s');
        $creater = input('param.set_creater/s');
        $abstract = input('param.set_abstract/s');
        $tabstract = input('param.set_tabstract/s');
        $keyword = input('param.set_keyword/s');
        $project = input('param.set_project/s');
        $country = input('param.set_country/s');
        $author = input('param.set_author/s');
        $institue = input('param.set_institue/s');
        $journal = input('param.set_journal/s');
        $issne = input('param.set_issne/s');
        $issnp = input('param.set_issnp/s');
        $issnl = input('param.set_issnl/s');
        $urgency = input('param.set_urgency/s');
        $special_version = input('param.set_special_version/s');
        $auditor = input('param.set_auditor/s');
        $labelor = input('param.set_labelor/s');
        $final_auditor = input('param.set_final_auditor/s');
        $auditor_finished = input('param.set_auditor_finished/s');
        $labelor_finished = input('param.set_labelor_finished/s');
        $final_auditor_finished = input('param.set_final_auditor_finished/s');
        $uData = array();
        self::_assignData($uData,'title',$title);
        self::_assignData($uData,'kw_id',$kw_id);
        self::_assignData($uData,'issue',$issue);
        self::_assignData($uData,'impact_factor',$impact_factor);
        self::_assignData($uData,'journal_zone',$journal_zone);
        self::_assignData($uData,'status',$set_status);
        self::_assignData($uData,'doi',$doi);
        self::_assignData($uData,'creater',$creater);
        self::_assignData($uData,'abstract',$abstract);
        self::_assignData($uData,'tabstract',$tabstract);
        self::_assignData($uData,'keyword',$keyword);
        self::_assignData($uData,'project',$project);
        self::_assignData($uData,'country',$country);
        self::_assignData($uData,'author',$author);
        self::_assignData($uData,'institue',$institue);
        self::_assignData($uData,'journal',$journal);
        self::_assignData($uData,'issne',$issne);
        self::_assignData($uData,'issnp',$issnp);
        self::_assignData($uData,'issnl',$issnl);
        self::_assignData($uData,'urgency',$urgency);
        self::_assignData($uData,'special_version',$special_version);
        self::_assignData($uData,'auditor',$auditor);
        self::_assignData($uData,'labelor',$labelor);
        self::_assignData($uData,'final_auditor',$final_auditor);
        self::_assignData($uData,'auditor_finished',$auditor_finished);
        self::_assignData($uData,'labelor_finished',$labelor_finished);
        self::_assignData($uData,'final_auditor_finished',$final_auditor_finished);
        return $uData;
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
            $sql_str = PendingModel::with(['createUser', 'spiderKw'])
                ->where($where_map)->order($order_by, $ordertype)->buildSql(true);
            $res = PendingModel::with(['createUser', 'spiderKw','label'])
                ->where($where_map)->order($order_by, $ordertype)->paginate($page_size, false);
            return json(['code' => 1, 'msg' => '操作完成', 'data' => $res]);
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => '操作失败:' . $e->getMessage(), 'data' => []]);
        }
    }

    /**
     * 单个文章查看接口，返回完整html页面或仅内容页面
     */
    public function view($art_id = 0)
    {


    }



    /***
     *
     * 文章统一更新接口
     */
    public function update(){
        Db::startTrans();
        try {
            $where_map = Article::getSearchMap();
            $raw_uData = Article::getUpdateData();

            $auditor = input('param.set_auditor/s');
            $labelor = input('param.set_labelor/s');
            $final_auditor = input('param.set_final_auditor/s');

            $sp_values = [THIS_AVG, SUM_AVG];

            if(in_array($auditor,$sp_values) || in_array($labelor,$sp_values) || in_array($final_auditor,$sp_values)){
                // 处理可能特殊的初审核者
                if($auditor == THIS_AVG){
                    Task::_this_AvgDis('auditor', $where_map, $raw_uData);
                }else if($auditor == SUM_AVG){
                    Task::_sum_AvgDis('auditor', $where_map, $raw_uData);
                }

                // 处理可能特殊的标注者
                if($labelor == THIS_AVG){
                    Task::_this_AvgDis('labelor', $where_map, $raw_uData);
                }else if($labelor == SUM_AVG){
                    Task::_sum_AvgDis('labelor', $where_map, $raw_uData);
                }

                // 处理可能特殊的终审者
                if($final_auditor == THIS_AVG){
                    Task::_this_AvgDis('final_auditor', $where_map, $raw_uData);
                }else if($final_auditor == SUM_AVG){
                    Task::_sum_AvgDis('final_auditor', $where_map, $raw_uData);
                }
            }else{
                PendingModel::where($where_map)->update($raw_uData);
            }
            // 提交事务
            Db::commit();
            return json(['code' => 1, 'msg' => '操作完成']);
        }catch (\Exception $e) {

            // 回滚事务
            Db::rollback();
            return json(['code' => 0, 'msg' => '操作失败:' . $e->getMessage(), 'data' => []]);
        }
    }

    /**改变status状态
     * @return \think\response\Json
     */
    public function setStatus()
    {
        try {
            $where_map = Article::getSearchMap();
            $status = input('param.status/s'); // 默认状态不改变
            $set_status = input('param.set_status/s', $status);
            PendingModel::where($where_map)->update(['status' => $set_status]);
            return json(['code' => 1, 'msg' => '操作完成']);

        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => '操作失败' . $e->getMessage()]);
        }
    }

    /*
     * 文章删除 一个或多个，或条件删除
     */
    public function del($delete_t='-1')
    {
        try {
            $where_map = Article::getSearchMap();
            if($delete_t === '-1'){ // 软删除, 设置状态为-1
                PendingModel::where($where_map)->update(['status'=>-1]);
            }else if($delete_t === '-2'){ // 黑名单, 设置状态为-2
                PendingModel::where($where_map)->update(['status'=>-2]);
            }else if($delete_t === '-3'){ // 硬删除，这次是真的删除了，库中没有了
                PendingModel::where($where_map)->delete();
            }else{
                throw new \Exception('未知的删除类型');
            }
            return json(['code' => 1, 'msg' => '操作完成']);
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => '操作失败' . $e->getMessage()]);
        }
    }

    /**文章添加
     * @return \think\response\Json
     */
    public function add()
    {
        try {
            $data = $this->request->post();
            $data['issue'] = strtotime($data['issue']);
            $data['issue'] = date("Y-m", $data['issue']);
            $data['creater'] = getCurUser()['uid'];
            $data['project'] = 'MAN';
            $art_id = $data['art_id'];
            $label_ids = $data['label_ids'];
            $label_ids =  explode(',',$label_ids);
            if ($data['status'] == 0) {
                ArticleLabelModel::addLabel($art_id,$label_ids);
                unset($data['label_ids']);
                $res = PendingModel::where('art_id', $art_id)->find();
                if ($res) {
                    return json(['code' => 25, 'msg' => '操作失败:该art_id已存在！！！']);
                }

                $res = PendingModel::create($data);
                if (!$res) {
                    return json(['code' => 25, 'msg' => '操作失败']);
                }
            }
            return json(['code' => 1, 'msg' => '操作成功']);
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => '操作失败' . $e->getMessage()]);
        }
    }

    /**
     * 文章编辑
     */
    public function edit()
    {
        try {
            if ($this->request->isPost()) {
                $data = $this->request->post();
                $art_id = $data['art_id'];
                if($data['pre_status']<$data['status']){
                    if($data['status'] == 2)
                        $data['auditor_finished'] = 1;
                    if($data['status'] == 3)
                        $data['labelor_finished'] = 1;
                    if($data['status'] == 4)
                        $data['final_auditor_finished'] = 1;
                }
                unset($data['pre_status']);

                $where = array('art_id' => intval($art_id)); //更新条件

                $label_add = $data['label_add'];
                if(!empty($label_add)){
                    $label_add =  explode(',',$label_add);
                    ArticleLabelModel::addLabel($art_id,$label_add);

                    //ArticleLabelModel::delLabel($art_id,$label_ids);
                }
                $label_del = $data['label_del'];
                //$label_del = input('param.label_del/a');
                if(!empty($label_del)){
                    $label_del =  explode(',',$label_del);
                    $label_arr = ['IN'];
                    foreach($label_del as $label){
                        array_push($label_arr,(int)$label);
                    }
                    ArticleLabelModel::delLabel($art_id,$label_arr);
                }
                unset($data['label_add']);
                unset($data['label_del']);

                $res = PendingModel::update($data,$where);
                if (!$res) {
                    return json(['code' => 0, 'msg' => '操作失败']);
                }
                return json(['code' => 1, 'msg' => '操作成功','data' => $data]);
            }
            $art_id = input('param.art_id/s');
            $art_arr = PendingModel::where('art_id', $art_id)->find()->toArray();
            $this->assign('art_arr', $art_arr);

            // 标签列表
            $label_list = LevellabelModel::where('status','1')->select();
            $this->assign('label_list', $label_list);


            $label = ArticleLabelModel::getLabelByArtID($art_id);
            $this->assign('label',$label);
            $this->view->engine->layout(false);

            $data = input('param.status/s');
            switch ($data)
            {
                case '1':  //文献初审
                    return $this->fetch('auditor_form');
                case '2':  //文献标注
                    return $this->fetch('labelor_form');
                case '3':  //文献终审
                    return $this->fetch('final_auditor_form');
                case '4':  //文献输出
                    return $this->fetch('form');
                default :
                    return $this->fetch('form');
            }

        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => '操作失败' . $e->getMessage()]);
        }
    }

    /**
     *
     * 数据导出
     */
    public function exportExcel()
    {
        try {
            // Create new PHPExcel object
            $objPHPExcel = new \PHPExcel();
            $file_name = date("YmdHis",time()).'.xlsx';

            // Set document properties
            $objPHPExcel->getProperties()->setCreator("中粮数据挖掘系统v2.0.3")
                ->setTitle("检索数据导出")
                ->setSubject("数据自动导出");


            $where_map = Article::getSearchMap();
            $results = PendingModel::where($where_map)->select()->toArray();

            if(empty($results)){
                throw new Exception('没有结果');
            }

            foreach ($results as $row=>$row_ele){
                $col = 0;
                if($row == 0){
                    foreach ($row_ele as $filed_name=>$value){
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col, $row+1, $filed_name);
                        $col += 1;
                    }
                }
                $col = 0;
                foreach ($row_ele as $filed_name=>$value){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col, $row+2, $value);
                    $col += 1;
                }
            }

            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('检索数据');
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            // Redirect output to a client’s web browser (Excel5)
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$file_name.'"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit;
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => '操作失败' . $e->getMessage()]);
        }

    }
}