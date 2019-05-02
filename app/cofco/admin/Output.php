<?php


namespace app\cofco\admin;


use app\admin\controller\Admin;
use app\admin\model\AdminUserlog as LogModel;
use app\cofco\model\AdminId as IdModel;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;

include("app\cofco\common\getMap.php");
/** 预审核页面
 * Class Prepending
 * @package app\cofco\admin
 */
class Output extends Admin
{
    public function index()
    {
        $keyword_list = KwModel::select();
        $this->assign('keyword_list', $keyword_list);
        return $this->fetch();
    }

    public function data(){
        $map = getDataMap(4);
        $listRows = input('param.limit/s');
        $data_list = PendingModel::where($map)->paginate($listRows,false);
        return json(['data'=>$data_list,'code'=>0,'message'=>'操作完成']);
    }

    public function edit($id = 0)
    {
        if ($this->request->isPost()) {
            $map = [];
            $map['pid'] = $id;
            IdModel::where($map)->delete();
            $data = $this->request->post();
            $data['final_auditor'] = $_SESSION['hisiphp_']['admin_user']['nick'];
//            $data['issue']=strtotime($data['issue']);
            if($data['status']==2) {
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
                else {
                    $var1=explode("#",$data['tag_id']);
                    for ($x=0;$x<count($var1);$x++) {
                        $array = array("pid" =>$data['id'] , "tid" =>$var1[$x]);
                        if (!(IdModel::create($array))) {
                            return $this->error('修改失败。');
                        }
                    }
                    return $this->success('修改成功。', 'index');


                }
            }
            if($data['status']==4) {
                // 进入终审核
                $logmap = getLogMap(2,$id);
                $result = LogModel::insert($logmap);
                if (!$result) {
                    return $this->error('修改失败！');
                }
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
                else
                {
                    return $this->success('添加成功。', 'index');

                }

            }
            if($data['status']==3) {
                // 进入终审
                $logmap = getLogMap(3,$id);
                $result = LogModel::insert($logmap);
                if (!$result) {
                    $this->error = '错误';
                    return false;
                }
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
                else
                {
                    $var1=explode("#",$data['tag_id']);
                    for ($x=0;$x<count($var1);$x++) {
                        $array = array("pid" =>$data['id'] , "tid" => "");
                        if (!(IdModel::create($array))) {
                            return $this->error('修改失败。');
                        }
                    }
                    return $this->success('添加成功。', 'index');
                }

            }

        }
        $row1 = PendingModel::where('id', $id)->find()->toArray();
        $row1 = str_replace('?', ' ', $row1);
        $tag_id = $row1['tag_id'];
        if ($tag_id != null) {
            $var=explode("#",$tag_id);
            $array = array("value"=>"");
            for($x=0;$x<count($var);$x++)
            {
                $row2 = LevellabelModel::where('id', $var[$x])->field('value')->find()->toArray();
                //$row2 = str_replace(PHP_EOL, '#', $row2);
                if($x==0)
                {
                    $array['value']=$row2['value'];
                }
                else
                {
                    $array['value']=$array['value'].'#'.$row2['value'];
                }
            }
        }
        else
            $array = array();
        //var_dump($array);
        $row = array_merge($row1, $array);
        $row['author'] = PendingModel::strFilter($row['author']);
        $row['keyword'] = PendingModel::strFilter($row['keyword']);
        $row['country'] = PendingModel::strFilter($row['country']);
        $row['institue'] = PendingModel::strFilter($row['institue']);
        $row['doi'] = PendingModel::strFilter1($row['doi']);
        if (substr($row['doi'] , 0 , 2)=='//')
            $row['doi']=substr($row['doi'], 10);
        $this->assign('data_info', $row);
        return $this->afetch('form');
    }

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
}