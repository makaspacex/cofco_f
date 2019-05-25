<?php


namespace app\cofco\admin;

use app\cofco\model\AdminPending as PendingModel;
use app\system\model\SystemUser;
use think\db\Where;

/**终审页面
 * Class finaly
 * @package app\cofco\admin
 */
class Task extends AdminBase
{
    public function index()
    {
        $this->init_searchForm();
        return $this->fetch();
    }
    /***
     *
     * 任务分配 页面
     */
    public function distribution(){
        $this->init_searchForm();
        $this->assign('art_status', '0');
        return $this->fetch();
    }

    /***
     *  所有数据
     *
     * @return string
     */
    public function all(){
        $this->init_searchForm();
        $this->assign('art_status', '');
        return $this->fetch();
    }

    /***
     *  总体任务进度查看页面
     *
     * @return string
     */
    public function progress(){
        $this->init_searchForm();
        $this->assign('art_status', '7');
        $details_uid = input('param.details_uid/s');
        if(!empty($details_uid)){
            $proinfo = Task::getUserProcess($details_uid);
            $this->assign('proinfo', $proinfo);
            $this->view->engine->layout(false);
            return $this->fetch('mprogress_details');
        }
        $users = SystemUser::all();
        $proinfos = [];
        foreach( $users as $key=>$user){
            $proinfos[] = Task::getUserProcess($user['id']);
        }
        $this->assign('proinfos', $proinfos);
        return $this->fetch();
    }


    /***
     *
     * 根据用户，获取该用户的进度信息
     * @param $uid
     * @return array
     */
    public static function getUserProcess($uid){
        $result = [];
        $user = SystemUser::get(['id'=>$uid]);

        $chushen_num_finished = PendingModel::where(new Where(['status'=>['IN',['1','2','3']],'auditor'=>['EQ',$uid],'auditor_finished'=>'1']))->count();
        $chushen_num_unfinished = PendingModel::where(new Where(['status'=>['IN',['1','2','3']],'auditor'=>['EQ',$uid],'auditor_finished'=>'0']))->count();
        $biaozhu_num_finished = PendingModel::where(new Where(['status'=>['IN',['1','2','3']],'labelor'=>['EQ',$uid],'labelor_finished'=>'1']))->count();
        $biaozhu_num_unfinished = PendingModel::where(new Where(['status'=>['IN',['1','2','3']],'labelor'=>['EQ',$uid],'labelor_finished'=>'0']))->count();
        $zhongshen_num_finished = PendingModel::where(new Where(['status'=>['IN',['1','2','3']],'final_auditor'=>['EQ',$uid],'final_auditor_finished'=>'1']))->count();
        $zhongshen_num_unfinished = PendingModel::where(new Where(['status'=>['IN',['1','2','3']],'final_auditor'=>['EQ',$uid],'final_auditor_finished'=>'0']))->count();

        $chushen_num = $chushen_num_finished+$chushen_num_unfinished;
        $biaozhu_num = $biaozhu_num_finished+$biaozhu_num_unfinished;
        $zhongshen_num = $zhongshen_num_finished+$zhongshen_num_unfinished;

        $chushen_rate  = $chushen_num==0?'0':100*$chushen_num_finished/$chushen_num;
        $biaozhu_rate  = $biaozhu_num==0?'0':100*$biaozhu_num_finished/$biaozhu_num;
        $zhongshen_rate  = $zhongshen_num==0?'0': 100*$zhongshen_num_finished/$zhongshen_num;

        $zongshu = $chushen_num+$biaozhu_num+$zhongshen_num;
        $zongshu_rate  =$zongshu==0?'0':100*($chushen_num_finished+$biaozhu_num_finished+$zhongshen_num_finished)/$zongshu;
        $zongshu_finished = $chushen_num_finished+$biaozhu_num_finished+$zhongshen_num_finished;
        $zongshu_unfinished = $chushen_num_unfinished+$biaozhu_num_unfinished+$zhongshen_num_unfinished;

        $result['user'] = $user;
        $result['zongshu'] = $zongshu;
        $result['zongshu_finished'] = $zongshu_finished;
        $result['zongshu_unfinished'] = $zongshu_unfinished;
        $result['zongshu_rate'] = sprintf("%.2f",$zongshu_rate);
        $result['chushen_num'] = $chushen_num;
        $result['chushen_num_finished'] = $chushen_num_finished;
        $result['chushen_num_unfinished'] = $chushen_num_unfinished;
        $result['chushen_rate'] = sprintf("%.2f",$chushen_rate);
        $result['biaozhu_num'] = $biaozhu_num;
        $result['biaozhu_num_finished'] = $biaozhu_num_finished;
        $result['biaozhu_num_unfinished'] = $biaozhu_num_unfinished;
        $result['biaozhu_rate'] = sprintf("%.2f",$biaozhu_rate);
        $result['zhongshen_num'] = $zhongshen_num;
        $result['zhongshen_num_finished'] = $zhongshen_num_finished;
        $result['zhongshen_num_unfinished'] = $zhongshen_num_unfinished;
        $result['zhongshen_rate'] = sprintf("%.2f",$zhongshen_rate);

        return $result;
    }

    /***
     *  我的任务进度查看页面
     *
     * @return string
     */
    public function mprogress(){
        $this->init_searchForm();
        $this->assign('art_status', '7');
        $proinfo = Task::getUserProcess(getCurUser()['uid']);
        $this->assign('proinfo', $proinfo);
        return $this->fetch();
    }

    /***
     * 我的任务总览页面
     *
     */

    public function view(){
        $this->init_searchForm();
        $this->assign('art_status', '1');
        return $this->fetch();
    }

    /***
     * 文献初审页面
     */
    public function auditor(){
        $this->init_searchForm();
        $this->assign('art_status', '1');
        return $this->fetch();
    }

    /***
     * 文献标注页面
     */
    public function labelor(){
        $this->init_searchForm();
        $this->assign('art_status', '2');
        return $this->fetch();
    }

    /***
     * 文献终审页面
     */
    public function final_auditor(){
        $this->init_searchForm();
        $this->assign('art_status', '3');
        return $this->fetch();
    }


}