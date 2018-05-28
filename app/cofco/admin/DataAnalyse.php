<?php
namespace app\cofco\admin;
use app\admin\controller\Admin;


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

class DataAnalyse extends Admin
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
    public function image()
    {
        $x_value = [
            [1,2,3,4,5,6,7,8,21,26],
            [11,12,13,14,15,16,17,18]
        ];
        $y_value = [
            [9,8,7,6,5,4,3,1,8,8],
            [11,12,13,14,15,16,17,18]
        ];
        $receive_x = [];
        $receive_y = [];
        foreach($x_value as $k=>$v){
            $receive_x = array_merge($x_value[$k],$receive_x);
            $max_x = max($receive_x);
            $min_x = min($receive_x);
        }
        foreach($x_value as $k=>$v){
            $receive_y = array_merge($y_value[$k],$receive_y);
            $max_y = max($receive_y);
            $min_y = min($receive_y);
        }
        $range_y= $max_y - $min_y;//计算y轴极差
        $range_x= $max_x - $min_x;//计算x轴极差
        $array_y_length = count($y_value);
        $img = imagecreate(430, 330);
        $file= "@storage/picture/test";
        $r=[hexdec("fd"),81,hexdec("cc"),88,82,hexdec("fd"),73,hexdec("bd"),hexdec("6e"),54,hexdec("c4")];
        $g=[hexdec("a6"),hexdec("ca"),hexdec("a8"),hexdec("cc"),hexdec("a0"),hexdec("db"),hexdec("5b"),hexdec("a2"),70,65,hexdec("cc")];
        $b=[hexdec("7e"),hexdec("cc"),hexdec("ba"),81,hexdec("c5"),hexdec("7e"),hexdec("a1"),hexdec("9a"),74,70,hexdec("d3")];
        $green = imagecolorallocate($img, 213, 235, 213);//图画的背景颜色是有作用的
        $black = imagecolorallocate($img, 0, 0, 0);
        $red = imagecolorallocate($img, 255, 0, 0);
        $position_x = 30;//获取在x轴的位置
        $position_y = 295;//获取在y轴上的位置
        $average_y = ceil(($range_y ) / 10);//每一个在y轴上面分配到的数据
        $average_x = ceil(($range_x ) / 10);//每一个在x轴上边分配到的数据
        $top_y = $max_y + $average_y;
        //以上两行属于获取原点的位置
        imageline($img, 30, 300, 400, 300, $black);//坐标轴x轴
        imageline($img, 30, 300, 30, 20, $black);//坐标轴y轴
        $ydata = $min_y;
        $xdata = $min_x;
        for ($i = 0; $i < 10; $i++) {
            imagestring($img, 13, 15, $position_y, $ydata, $black);
            $position_y = $position_y - 30;
            $useydata[] = $ydata;
            $ydata = $ydata + $average_y;
        }//y轴上边显示的数据
        for ($i = 0; $i < 10; $i++)                                                                                                                                      {
            imagestring($img, 13, $position_x, 300, $xdata, $black);
            $position_x = $position_x + 37;
            $usexdata[] = $xdata;
            $xdata = $xdata + $average_x;
        }//x轴上边显示的数据
        for($s = 0;$s<$array_y_length;$s++) {
            $point_x=[];//没有重置point_x
            $point_y=[];
            /**
             *这边要加一个判断在数据的范围内增加一个量级使得所取得的数据大于最大值
             */
            $length_x = count($x_value[$s]);
            /**
             * 获取数据点的思路 把像素分割成点 这个数值占总数之乘上x或y总的像素值
             *   $pixel = 数值 / 最大刻度 * 该轴最大的像素值;         //分割像素
             */
            $color = imagecolorallocate($img,$r[$s],$g[$s],$b[$s]);
            foreach ($x_value[$s] as $x) {
                $pixel_x = $x /(max($usexdata)-$min_x) * 370+30;
                $point_x[] = $pixel_x;
            }//点在x轴上边分配到的像素
            foreach ($y_value[$s] as $y) {
                $pixel_y = -($y / (max($useydata)-$min_y) * 240)+300;
                $point_y[] = $pixel_y;
            }
            for ($l = 0; $l < $length_x; $l++) {
                $a = $l + 1;
                $b = $a < $length_x ? $a : $length_x - 1;//laravel框架需要这样使用三目运算需要找一个变量接受运算之后的结果
                imagefilledellipse($img, $point_x[$l], $point_y[$l], 5, 5, $red);
                imageline($img, $point_x[$l], $point_y[$l], $point_x[$b], $point_y[$b], $color);
            }//点在y轴上分配到的像素
        }
        imagepng($img);
        imagedestroy($img);
        return response(200)
            ->header('content-type','image/jpeg');
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