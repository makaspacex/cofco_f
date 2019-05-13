<?php


namespace app\cofco\admin;

use app\admin\model\AdminUserlog as LogModel;
use app\cofco\model\AdminId as IdModel;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;

include("app".DS."cofco".DS."common".DS."getMap.php");
/**审核及标注页面
 * Class pending
 * @package app\cofco\admin
 */

class pending extends AdminBase
{
    /**主页
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $keyword_list = KwModel::all();
        $this->assign('keyword_list', $keyword_list);
        $this->assign('art_status', 2);
        return $this->fetch();
    }

    /**数据API
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function data(){
        $map = getDataMap(2);
        $listRows = input('param.limit/s');
        $data_list = PendingModel::where($map)->paginate($listRows,false);
        return json(['code'=>0,'message'=>'操作完成','data'=>$data_list]);
    }

    public function edit($art_id = 0)
    {

        $row = PendingModel::where('art_id', $art_id)->find()->toArray();
        $this->assign('data_info', $row);
        return $this->afetch('form');
    }

    public function del()
    {
        $ids = input('param.ids/s');
        $map = [];
        $map['id'] = ['in', $ids];
        var_dump($map);
        $res = PendingModel::where($map)->delete();
        if ($res === false) {
            return $this->error('添加失败。','index');;
        }
        return $this->success('操作成功！','index');
    }

    public function getAllIdByCondition(){

        $map = getDataMap(2);
        $ids = PendingModel::where($map)->field('id')->select();
        $count = sizeof($ids);
        $ids_arr = Array();
        foreach($ids as $id){
            array_push($ids_arr,$id['id']);
        }
        return json_encode(['code'=>'0','message'=>"操作成功",'count' => $count,'data' => $ids_arr]);
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['creater'] = $_SESSION['hisiphp_']['admin_user']['nick']; //审核人
            $data['issue']=strtotime($data['issue']);
            $data['issue']=date("Y-m", $data['issue']);
            if($data['status']==2) {
                unset($data['id']);
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                return $this->success('添加成功。', 'index');
            }
            if($data['status']==3) {
                if (!PendingModel::create($data)) {
                    return $this->error('添加失败！');
                }
                else
                {
//                    unset($data['id']);
//                    if (!FinalyModel::create($data)) {
//                        return $this->error('添加失败！');
//                    }
                    return $this->success('添加成功。','index');
                }
            }
        }
        return $this->afetch('pending_form');
    }


}