<?php


namespace app\cofco\admin;


use app\cofco\model\AdminKw as KwModel;
use think\Config;

class Keyword extends AdminBase
{
    protected function initialize()
    {
        parent::initialize();
        $tab_data['menu'] = [
            [
                'title' => '添加Pubmed爬虫关键词',
                'url' => 'cofco/keyword/addpubmedkw',
            ],
            [
                'title' => '添加Science爬虫关键词',
                'url' => 'cofco/keyword/addsciencekw',
            ],

        ];
        $this->tab_data = $tab_data;
    }



    /**爬虫关键词列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        //$data_list = KwModel::paginate();

        $sql = 'SELECT a.username ,b.*  FROM `hisi_system_user` a,cofco_admin_kw b WHERE a.id = b.uid';
        $data_list = KwModel::query($sql);

        // 分页
        //$pages = $data_list->render();
        $this->assign('data_list', $data_list);
        //$this->assign('pages', $pages);
//        var_dump($data_list);
        return $this->fetch();
    }

    /**
     * 关键词list数据
     */
    public function data(){
        $sql = 'SELECT a.username ,b.*  FROM `hisi_system_user` a,cofco_admin_kw b WHERE a.id = b.uid';
        $data_list = KwModel::query($sql);
        foreach($data_list as &$data){  //时间戳转换
            $data['ctime'] = date("Y-m-d H:i", $data['ctime']);
        };
        return json(['data'=>$data_list,'status'=>0,'message'=>'操作完成']);
    }

    /**
     * 添加pubmed爬虫关键词
     */
    public function addpubmedkw()
    {

        if ($this->request->isPost()) {
            $data = $this->request->post();
            unset($data['name']);
            $map = [];
            $map['name'] = input('param.name/s');;
            $map['type'] = 1;  // 0代表pubmed关键词
            $map['value'] = json_encode($data);
            $map['uid'] = getCurUser()['uid'];
            $map['status'] = 1;
            $map['sstatus'] = 0; //关键词使用状态 1 代表已使用  0代表未使用
            if(KwModel::create($map)){
                return $this->success('创建成功');
            }
            return $this->sucess('创建失败');
        }

        $keyword_list = KwModel::select();
        $uid = getCurUser()['uid'];
        $uname = getCurUser()['nick'];
        $this->assign('uid',$uid);
        $this->assign('uname',$uname);
        $this->assign('controlspider_url',config('controlspider_url'));
        $this->assign('keyword_list', $keyword_list);
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    /**添加science爬虫关键词
     * @return mixed
     */
    public function addsciencekw()
    {

        if ($this->request->isPost()) {
            $data = $this->request->post();
            unset($data['name']);
            $map = [];
            $map['name'] = input('param.name/s');;
            $map['type'] = 2;
            $map['value'] = json_encode($data);
            $map['uid'] = getCurUser()['uid'];
            $map['status'] = 1;
            $map['sstatus'] = 0; //关键词使用状态 1 代表已使用  0代表未使用
            if(KwModel::create($map)){
                return $this->success('创建成功');
            }
            return $this->sucess('创建失败');
        }
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    /**
     * 关键词删除
     */
    public function kwdel()
    {
        $ids = input('param.ids/s');
        $map = [];
        $map['id'] = ['in', $ids];
        var_dump($map);
        $res = KwModel::where($map)->delete();
        if ($res === false) {
            return $this->error('操作失败！');
        }
        return $this->success('操作成功！');
    }

    /**
     * 更改关键词状态
     */
    public function setstatus()
    {
        $ids = input('param.ids/s');
        $status = input('param.status/s');
        $map = [];
        $map['id'] = ['in',$ids];
        if($status){
            $map['status'] = 0;
        }
        else{
            $map['status'] = 1;
        }
        $res = KwModel::update($map);
        if($res){
            return $this->success("修改成功");
        }
        return $this->error("修改失败");
        

    }

}