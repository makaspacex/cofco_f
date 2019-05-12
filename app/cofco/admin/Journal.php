<?php

namespace app\cofco\admin;

use app\cofco\model\AdminKw as KwModel;
use think\Config;


class Journal extends AdminBase
{

    public function index()
    {
        return $this->fetch();
    }

}