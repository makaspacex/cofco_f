<?php


namespace app\cofco\admin;


class Spiderdata extends AdminBase
{
    /** 主页
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
//        $article = PendingModel::with(['createUser','spiderKw'])->where(['art_id'=>'30844296'])->find()->toArray();
        $this->init_searchForm();
        $this->assign('art_status', 1);
        return $this->fetch();
    }

}