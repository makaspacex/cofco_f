<?php
namespace app\cofco\admin;
use app\admin\controller\Admin;

class Index extends Admin
{
    public function index()
    {
        $welcome_html = config('module_cofco.cofco_welcome_info');

        $this->assign('welcome_html',$welcome_html);

        return $this->afetch();
    }
}