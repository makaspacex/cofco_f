<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------

namespace app\cms\home;

use app\cms\model\CmsTag as TagModel;

class Tag extends Base
{
    public function _empty()
    {

        $tag    = $this->request->action();
        $mid    = $this->request->param('mid/d', 2);
        $page   = $this->request->param('page/d', 1);

        $assign = [
            'tag' => $tag,
        ];

        // 防止分页出现多次统计
        if ($page == 1) {
            TagModel::where('mid', $mid)->where('name', $tag)->setInc('search_count', 1, 10);
        }

        $this->assign($assign);

        return $this->fetch('index');
    }
}