<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\common\controller\Common;
use think\Loader;
/**
 * 后台公共控制器
 * @package app\admin\controller
 */
class Publics extends Common
{
    /**
     * 登陆页面
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function index()
    {
        $model = model('AdminUser');
        if ($this->request->isPost()) {
            $username = input('post.username/s');
            $password = input('post.password/s');
            if (!$model->login($username, $password)) {
                return $this->error($model->getError(), url('index'));
            }
            return $this->success('登陆成功，页面跳转中...', url('index/index'));
        }

        if ($model->isLogin()) {
            $this->redirect(url('index/index', '', true, true));
        }

        return $this->fetch();
    }

    /**
     * register page
     * @author lifh fh.li@foxmail.com
     * @return mixed
     */
    public function register()
    {
        $model = model('AdminUser');
        if($this->request->isPost()){
            $username = input('post.username/s');
            $password = input('post.password/s');
            $password1 = input('post.password1/s');
            $nick = input('post.nick/s');
            $mobile = input('post.mobile/s');
            $email = input('post.email/s');
            //$data = input('post.');
            //var_dump($data);
            setcookie("username", $username, time()+10);
            setcookie("nick", $nick, time()+10);
            setcookie("mobile", $mobile, time()+10);
            setcookie("email", $email, time()+10);
            if(!$model->register($username,$password,$nick,$mobile,$email)){
                if( $password != $password1){
                    return $this->error('两次密码输入不一致',url('register'));
                }
                else{
                    setcookie("password", $password, time()+10);
                    setcookie("password1", $password1, time()+10);
                }
                return $this->error($model->getError(),url('register'));
            }
            return $this->success('注册成功，跳转到登陆页面',url('index'));
        }

        return $this->fetch();
    }

    /**
     * 退出登陆
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function logout(){
        model('AdminUser')->logout();
        $this->redirect(ROOT_DIR);
    }


    /**
     * 图标选择
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function icon() {
        return $this->fetch();
    }

    /**
     * 解锁屏幕
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function unlocked()
    {
        $_pwd = input('post.password');
        $model = model('AdminUser');
        $login = $model->isLogin();
        if (!$login) {
            return $this->error('登录信息失效，请重新登录！');
        }
        $password = $model->where('id', $login['uid'])->value('password');
        if (!$password) {
            return $this->error('登录异常，请重新登录！');
        }
        if (!password_verify($_pwd, $password)) {
            return $this->error('密码错误，请重新输入！');
        }
        return $this->success('解锁成功');
    }
}
