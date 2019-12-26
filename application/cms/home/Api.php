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

use App;

class Api extends Base
{
    // 跨域配置
    protected static $crossDoamin = [
        'Access-Control-Allow-Origin'       => '*',
        'Access-Control-Allow-Methods'      => 'GET, POST',
        'Access-Control-Allow-Credentials'  => 'true',
        'Access-Control-Allow-By'           => 'zASGlzaVBIUAZa',
        'Access-Control-Allow-Headers'      => 'Custom-Tag, User-Agent, Keep-Alive, Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With',
    ];

    public function _empty()
    {
        
        if ((int)config('module_cms.api_status') !== 1) {
            return $this->output('API已禁用，请进入后台启用');
        }

        if (!$this->checkSign()) {
            return $this->output('签名验证失败');
        }

        $version = config('module_cms.api_version') ? strtolower(config('module_cms.api_version')) : 'v1';
        $param  = $this->request->param();
        $contr  = App::controller($version, 'api');
        $action = 'api'.parse_name($this->request->action(), 1);
        
        return $this->output($contr->$action());

    }

    protected function checkSign()
    {
        
        if ((int)config('module_cms.api_sign_check') != 1) {
            return true;
        }

        $sign       = $this->request->param('sign');
        $timestamp  = $this->request->param('timestamp');
        $timeout    = config('module_cms.api_sign_timeout') ? config('module_cms.api_sign_timeout') : 60;

        if (strtotime($timestamp) > strtotime('+'.$timeout.' seconds')) {
            return false;
        }

        if (md5($sign) !== md5(md5($timestamp.config('module_cms.api_secret_key')))) {
            return false;
        }

        return true;
    }

    protected function output($data)
    {
    	$return = [];

    	if (is_array($data) || is_object($data)) {

            $return['code'] = 1;
            $return['msg']  = '';
            $return['data'] = $data;

    	} else {

            $return['code'] = 0;
            $return['msg']  = $data ? $data : '未知错误';
            $return['data'] = [];

    	}


    	return json($return, 200, self::$crossDoamin);
    }
}