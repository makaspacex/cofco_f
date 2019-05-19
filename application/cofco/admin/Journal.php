<?php

namespace app\cofco\admin;

use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminJournal;
use think\Config;
use app\cofco\model\AdminPending as PendingModel;
use think\db\Where;


class Journal extends AdminBase
{

    public function index()
    {
        return $this->fetch();
    }

    public function sync_info(){
        try {
            $res = AdminJournal::all();
            foreach ($res as $key=>$row){
                $data = ['impact_factor'=>$row['impact_factor'],'journal_zone'=>$row['journal_zone']];
                PendingModel::where(new Where(['issnl|issne|issnp'=>['LIKE', '%' . $row['issn'] . '%']]))->update($data);
            }
            return json(['code' => 0, 'message' => '操作完成']);
        } catch (\Exception $e) {
            return json(['code' => 25, 'message' => '操作失败' . $e->getMessage()]);
        }
    }

}