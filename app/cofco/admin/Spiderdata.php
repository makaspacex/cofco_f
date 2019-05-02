<?php


namespace app\cofco\admin;


use app\admin\controller\Admin;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminPending as PendingModel;
include("app\cofco\common\getMap.php");

class Spiderdata extends Admin
{
    /** 主页
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $keyword_list = KwModel::select();
        $this->assign('keyword_list', $keyword_list);
        return $this->fetch();
    }

    /** 爬虫数据API
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function data(){
        $map = getDataMap(1);
        $listRows = input('param.limit/s');
        $res = PendingModel::where($map)->paginate($listRows,false);
        if($res)
            return json(['code'=>0,'message'=>'操作完成','data'=>$res]);
        return json(['code'=>0,'message'=>'操作失败','data'=>[]]);
    }

    /**删除
     * @return mixed|void
     */
    public function del()
    {
        $ids = input('param.ids/s');
        $map = [];
        $map['id'] = ['in', $ids];
        $res = PendingModel::where($map)->delete();
        if ($res === false) {
            return $this->error('操作失败！');
        }
        return $this->success('操作成功！');
    }

    /**根据条件查询所有满足条件的ID
     * @return false|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAllIdByCondition(){
        $map = getDataMap(1);
        $ids = PendingModel::where($map)->field('id')->select();
        $count = sizeof($ids);
        $ids_arr = Array();
        foreach($ids as $id){
            array_push($ids_arr,$id['id']);
        }
        return json_encode(['code'=>'0','message'=>'操作成功','count' => $count,'data' => $ids_arr]);
    }

    /**审核通过
     *
     */
    public function passData(){
        $ids = input('param.ids/s');
        $map = [];
        $map['id'] = ['in', $ids];
        $map['creater'] = $_SESSION['hisiphp_']['admin_user']['nick']; //创建人
        $map['status'] = 2; //审核及标注状态
        if (!PendingModel::update($map)) {
            return $this->error('修改失败！');
        }
        return $this->success('操作成功！');

    }

}