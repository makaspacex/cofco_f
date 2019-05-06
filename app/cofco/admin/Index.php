<?php
namespace app\cofco\admin;

class Index extends AdminCOFCO
{
    public function index()
    {
        $welcome_html = "欢迎！";

        $this->assign('welcome_html',$welcome_html);

        return $this->afetch();
    }
}