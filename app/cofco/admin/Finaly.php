<?php


namespace app\cofco\admin;


use app\admin\controller\Admin;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;

/**终审页面
 * Class finaly
 * @package app\cofco\admin
 */
class finaly extends Admin
{

    public function index()
    {
        $keyword_list = KwModel::select();
        $this->assign('keyword_list', $keyword_list);
        return $this->fetch();
    }

    public function data()
    {
        $map = getDataMap(3);
        $listRows = input('param.limit/s');
        $data_list = PendingModel::where($map)->paginate($listRows,false);
        return json(['data'=>$data_list,'code'=>0,'message'=>'操作完成']);
    }

    public function edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['issue']=strtotime($data['issue']);

            if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
            return $this->success('修改成功。','index');
        }
        $row = PendingModel::where('id', $id)->find()->toArray();
        $row = str_replace('?', ' ', $row);
        $row = str_replace(PHP_EOL, '#', $row);
        $tag_id = $row['tag_id'];
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
        $row = array_merge($row, $array);

        $row['author'] = PendingModel::strFilter($row['author']);
        $row['keyword'] = PendingModel::strFilter($row['keyword']);
        $row['country'] = PendingModel::strFilter($row['country']);
        $row['institue'] = PendingModel::strFilter($row['institue']);
        $this->assign('data_info', $row);
        //var_dump($row);
        return $this->afetch('finaly_form');
    }

    public function del()
    {
        $ids = input('param.ids/a');
        $map = [];
        $map['id'] = ['in', $ids];
        $res = PendingModel::where($map)->delete();
        if ($res === false) {
            return $this->error('操作失败！');
        }
        return $this->success('操作成功！');
    }
}