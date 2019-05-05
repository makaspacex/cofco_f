<?php


namespace app\cofco\admin;


use app\admin\controller\Admin;
use app\cofco\model\AdminKw as KwModel;
use app\cofco\model\AdminPending as PendingModel;
use think\Config;

class Keyword extends Admin
{
    protected function _initialize()
    {
        parent::_initialize();
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


        $sql = 'SELECT a.username ,b.*  FROM `hisi_admin_user` a,hisi_admin_kw b WHERE a.id = b.uid';
        $data_list = KwModel::query($sql);

        // 分页
        //$pages = $data_list->render();
        $this->assign('data_list', $data_list);
        //$this->assign('pages', $pages);
//        var_dump($data_list);
        return $this->fetch();
    }


    /**
     * 添加pubmed爬虫关键词
     */
    public function addpubmedkw()
    {

        if ($this->request->isPost()) {
            $data = $this->request->post();
            var_dump($data);
        }

        $keyword_list = KwModel::select();
        $uid = $_SESSION['hisiphp_']['admin_user']['uid'];
        $uname = $_SESSION['hisiphp_']['admin_user']['nick'];
        $this->assign('uid',$uid);
        $this->assign('uname',$uname);
        $this->assign('controlspider_url',Config::get('controlspider_url'));
        $this->assign('keyword_list', $keyword_list);
        $tab_data = $this->tab_data;
        $tab_data['current'] = url('');
        $this->assign('tab_data', $tab_data);
        $this->assign('tab_type', 1);
        return $this->fetch();
    }

    /**添加science爬虫关键词
     * @return mixed
     */
    public function addsciencekw()
    {

        if ($this->request->isPost()) {
            $data = $this->request->post();
            $map = [];
            $map['name'] = input('param.name/s');;
            $map['type'] = 1;
            $map['value'] = json_encode($data);
            $map['uid'] = $_SESSION['hisiphp_']['admin_user']['uid'];
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

}