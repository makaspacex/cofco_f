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
        $keyword_list = KwModel::paginate();
        $this->assign('keyword_list', $keyword_list);
        return $this->fetch();
    }

    public function data()
    {
        $title = input('param.title/s');
        $sstr = input('param.sstr/s');
        $date_start = input('param.date_start/s');
        $date_end = input('param.date_end/s');
        $impact_factor_start = input('param.impact_factor_start/s');
        $impact_factor_end = input('param.impact_factor_end/s');
        $journal_zone = input('param.journal_zone/s');
        $map = array();
        if($title) {
            $map['title'] = ['like', '%' . $title . '%'];
        }
        if($sstr) {
            $map['sstr']= ['like', '%' . $sstr . '%'];
        }
        if($impact_factor_end) {
            $map['impact_factor']=['between',[$impact_factor_start,$impact_factor_end]];
        }
        if($date_start) {
            $date_start = strtotime($date_start);
            //var_dump($date_start);
            $date_end = strtotime($date_end);
            //var_dump($date_end);
            $map['ctime']=['between',[$date_start,$date_end]];
        }
        if($journal_zone) {
            $map['journal_zone']= $journal_zone;
        }
        $map['status']= '3';
        $listRows = input('param.limit/s');
        $data_list = PendingModel::where($map)->paginate($listRows,false);
        return json(['data'=>$data_list,'code'=>0,'message'=>'操作完成']);
    }

    public function edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['issue']=strtotime($data['issue']);
            if ($data['status']==3) {
                if (!PendingModel::update($data)) {
                    return $this->error('修改失败！');
                }
            }
            else{
                $re = PendingModel::where('pmid',$data['pmid'])->setField('status',2);
                if ($re == true) {
                    if (!PendingModel::where('id', $id)->delete()) {
                        return $this->error('修改失败！');
                    }
                    return $this->success('修改成功。','index');
                }
                return $this->error('修改失败！');
            }
            // 更新缓存
            //cache('system_member_level', KwModel::getAll());
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
//        if(mb_strlen($row['issue'],'utf8')>2)
//            $row['issue']=date("Y-m", $row['issue']);
//        else
//            $row['issue']=null;
        //var_dump($row);
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