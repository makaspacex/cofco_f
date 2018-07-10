<?php
namespace app\cofco\admin;
use app\admin\controller\Admin;
use app\cofco\model\AdminLabel as LabelModel;
use app\cofco\model\AdminTag as TagModel;
use app\cofco\model\AdminLevellabel as LevellabelModel;
use app\cofco\model\AdminPending as PendingModel;
use app\cofco\model\AdminFinaly as FinalyModel;
use app\cofco\model\AdminId as IdModel;
use think\Exception;
use think\Db;

/**
 * Class Spider

 该文件要实现人工输入功能如下：
    一、手动输入页面
        1、标题[必填]
        2、DOI[必填]
        3、摘要[必填]
        4、中文翻译[可选]
        5、标签选择[必填]
    二、半自动输入页面
        方式1：输入URL->爬取结果显示[可编辑，包含文献基本信息]，选择标签[必填]，中文翻译[可选]->入库
        方式2：输入关键词->结果显示，可选择：进入待审核数据库或进入黑名单或点击其中一篇按照方式1编辑入库
 *
 *
 *
 * @package app\COFCO\admin
 */

class Dataanalyse extends Admin
{
    /*
     * 数据标注说明
     * */
    public function index()
    {
        $welcome_html = config('dataanalyse.dataanalyse_welcome_info');
        $this->assign('welcome_html',$welcome_html);
        return $this->afetch();
    }

    /**
     * 标签列表
     * @return string
     */
    public function count($q='')
    {
        //$q = input('param.q/s');
        $var=explode("#",$q);
        $map = [];
        if ($q) {
            //$map['title'] = ['like', '%' . $q . '%'];
            $map = str_replace('#', ',', $q);
            $count=count($var);
            //$map['tid'] = ['in', $var];
        }
        if($q=='')
        {$data_list = PendingModel::where('status',-2)->paginate();
            $pages = $data_list->render();
            $this->assign('data_list', $data_list);
            $this->assign('pages', $pages);
        }
        else {
            $data_list = Db::query('SELECT SpiderApp_content.id,SpiderApp_content.status,SpiderApp_content.title FROM SpiderApp_content LEFT JOIN hisi_admin_id ON hisi_admin_id.pid = SpiderApp_content.id WHERE hisi_admin_id.tid IN ('.$map.') GROUP BY SpiderApp_content.id HAVING COUNT(DISTINCT SpiderApp_content.id,hisi_admin_id.tid) = '.$count.' LIMIT 15');

        }
        //echo Db::table('spiderapp_content')->getLastSql();
        // 分页
        //$pages = $data_list->render();
        $temp=[];
        for ($x=0;$x<count($data_list);$x++){
            $temp[$x]=$data_list[$x]['id'];
        }
        $dd=LevellabelModel::getAllChild(0, 0);
       // $T=Db::query('SELECT * FROM hisi_admin_id where pid='.$temp[0].'');
        //count($dd[0]['childs'][2]['childs']) 实验类型个数
        $A=array();$B=array();$D=array();
        foreach ($dd[0]['childs'] as $k => $v){
            if ($v['value']=='实验类型'){
                $D=$v['childs'];
                foreach ($v['childs'] as $k => $t){
                    //var_dump($t['value']);
                    array_push($A,$t['value']);
                    array_push($B,0);
                }
            }
        }

        //var_dump($D);
        $temp[0]=324532;
        $temp[1]=324534;
        $temp[2]=324533;
        for ($x=0;$x<count($temp);$x++){
            $E=array();
            $T=Db::query('SELECT * FROM hisi_admin_id where pid='.$temp[$x].'');
            foreach ($T as $k=>$v){
                array_push($E,$v['tid']);
            }
//            for ($g=0;$g<count($E);$g++) {
//                $i=0;
//                foreach ($D as $k => $v1) {
//                    foreach ($v1['childs'] as $k => $v2) {
//                        if ($E[$g]==$v2['id']){
//                            //$p=Db::query('SELECT score FROM hisi_admin_levellabel where id='.$E[$g].'');
//                            $B[$i]= $B[$i]+(int)$v2['score'];
//                        }
//                  }
//                    $i++;
//                }
//
//            }
            $i = 0;
            foreach ($D as $k => $v1) {

                foreach ($v1['childs'] as $k => $v2) { $g = 0;
                    while ($g < count($E)) {
                        if ($E[$g] == $v2['id']) {
                            //$p=Db::query('SELECT score FROM hisi_admin_levellabel where id='.$E[$g].'');
                            $B[$i] = $B[$i] + (int)$v2['score'];
                        }
                        $g=$g+1;
                    }

                }
                $i++;
            }
        }

        //var_dump($c);
       if(count($temp)!=0){
           for($x=0;$x<count($B);$x++){
               $B[$x]=$B[$x]/count($temp);
           }
           $c = array_combine($A,$B);
       }
       else
           $c=null;

        //var_dump($c);
        $this->assign('data_list', $data_list);
        $this->assign('data_list1', $c);
        //$this->assign('pages', $pages);
        return $this->fetch();
    }
    public function levelpop1($q = '')
    {
        $q = input('param.q/s');
        $callback = input('param.callback/s');
        if (!$callback) {
            echo '<br><br>callback为必传参数！';
            exit;
        }
        $map = [];
        if ($q) {
            $map['value'] = ['like', '%' . $q . '%'];
        }
        else
            $map['status']=1;

        $menu_list = LevellabelModel::getAllChild(0, 0);
        //var_dump($menu_list[0]['childs']['1']);
        $this->assign('callback', $callback);
        $this->view->engine->layout(false);
        $this->assign('menu_list', $menu_list);
        return $this->fetch();
    }
    /**
     * 新建爬虫页面
     * @return string
     */
    public function spider_add()
    {
        return $this->afetch('spider_form');
    }

    /**
     * 编辑爬虫页面
     * @return string
     */
    public function spider_edit()
    {
        return $this->afetch('spider_form');
    }

    /**
     * 爬虫状态查看页面，建议使用web_socket技术
     * @return string
     */
    public function spider_status(){

        return $this->afetch();
    }

    /**
     * 爬虫关键词列表页面
     * @return string
     */
    public function keywords_list(){

        return $this->afetch();
    }

    /**
     * 新建关键词词组
     * @return string
     */
    public function keywords_add(){

        return $this->afetch('keywords_form');
    }

    /**
     * 编辑关键词词组
     * @return string
     */
    public function keywords_edit(){

        return $this->afetch('keywords_form');
    }

    /**
     * 删除关键词词组
     * @return string
     */
    public function keywords_del(){

        return $this->afetch();
    }


}