<?php
namespace app\cofco\admin;
use app\admin\controller\Admin;
use app\admin\model\AdminUserlog as LogModel;
use app\cofco\model\AdminPending as PendingModel;
use think\Config;
use think\Exception;
include("app".DS."cofco".DS."common".DS."getMap.php");
include("app".DS."cofco".DS."config.php");

//include("app/cofco/common/getMap.php");
//include("app/cofco/config.php");
class upload extends Admin
{
    protected function _initialize()
    {
        parent::_initialize();
        $tab_data['menu'] = [
            [
                'title' => '辅助输入',
                'url' => 'cofco/upload/assist',
            ],
            [
                'title' => '人工输入',
                'url' => 'cofco/upload/manual',
            ],
            [
                'title' => '爬虫输入',
                'url' => 'cofco/upload/spider',
            ],
        ];
        $this->tab_data = $tab_data;
    }

    /** 辅助输入
     * @return string|void
     */
    public function assist()
    {
        ini_set('max_execution_time', '60');
        $msg='';
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if (count($data) > 4) {
                $data['creater'] = $_SESSION['hisiphp_']['admin_user']['nick'];
                unset($data['id']);
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }

                $ids = PendingModel::field('id')->select();
                $tid = max($ids);

                // 插入日志 1代表人工输入
                $logmap = getLogMap(1,$tid);
                // 添加日志
                LogModel::insert($logmap);
                return $this->afetch('pending_pform');
            }

            $ch = curl_init();
            if ($data['doi']!=null)
            {$data['doi']='/'.$data['doi'];}//把doi处理成爬虫接受的字符
            curl_setopt($ch, CURLOPT_URL,config('spider.spider_api_crawurl'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLINFO_CONNECT_TIME, 3);
            curl_setopt($ch, CURLINFO_TOTAL_TIME, 3);

            curl_setopt($ch, CURLINFO_NAMELOOKUP_TIME, 3);

            try{
                $output = curl_exec($ch);

                $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                //return $this->error($http);
                if ($http != 200) {
                    curl_close($ch);
                    throw  new Exception('链接爬虫失败');
                }
                $data_list = json_decode($output, true);
                //var_dump($data_list);
                if ($data_list['status'] == 0) {
                    //return $this->error($data_list['msg']);
                    curl_close($ch);
                    $msg=$data_list['msg'];
                    throw  new Exception($msg);
//                    $msg=$data_list['msg'];
//                    $this->assign('msg', $msg);
//                    return $this->afetch('pending_fform');
                }
                //var_dump($data_list);
                $row = $data_list['data'];
                #$AAA=isset($row['issue']);
                // var_dump($row);
//                if (strlen((string)(int)$row['issue'])>2)
//                {$row['issue']=date("Y-m", (int)$row['issue']);}
                $this->assign('data_info', $row);
                return $this->afetch('pending_pform');
            }catch (Exception $exception){
                $msg=$exception->getMessage();
                //echo "<script>alert('$msg')</script>";
                $this->assign('msg', $msg);
                //return $this->afetch('pending_fform');
            }

        }
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->assign('msg', $msg);
        return $this->afetch('pending_fform');
    }

    /** 人工输入
     * @return string|void
     */
    public function manual()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['issue']=strtotime($data['issue']);
            $data['issue']=date("Y-m", $data['issue']);
            $data['creater'] = $_SESSION['hisiphp_']['admin_user']['nick'];
            if($data['status']==2) {
                unset($data['id']);
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                $ids = PendingModel::field('id')->select();
                $tid = max($ids);
                // 插入日志 1代表人工输入
                $logmap = getLogMap(1,$tid);
                LogModel::insert($logmap);
                return $this->success('添加成功。');
            }
        }
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        return $this->afetch('form');
    }

    /** 爬虫输入
     * @return mixed
     */
    public function spider()
    {
        try {
            $cu = curl_init();
            curl_setopt($cu, CURLOPT_URL, config('spider.spider_api_all'));
            //echo config('spider.spider_api_all');
            curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($cu, CURLOPT_CONNECTTIMEOUT_MS, 300);
            curl_setopt($cu, CURLOPT_TIMEOUT, 3);
            $ret = curl_exec($cu);
            //var_dump(json_decode($ret,true));
            $http = curl_getinfo($cu, CURLINFO_HTTP_CODE);
            if ($http != 200) {
                throw  new Exception('链接爬虫失败');
            }
            curl_close($cu);
            $row = json_decode($ret,true);
            //var_dump($row);
            $data_list=$row['data'];
            $msg=$row['msg'];
            $this->assign('msg', $msg);
            //var_dump($data_list);
        }catch (Exception $exception){
            $data_list = array();
            $msg=$exception->getMessage();
            $this->assign('msg', $msg);

        }
        $this->assign('getthreadstatus_url',Config::get('getthreadstatus_url'));
        $this->assign('controlspider_url',Config::get('controlspider_url'));
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->assign('data_list', $data_list);
        return $this->fetch();
    }

}