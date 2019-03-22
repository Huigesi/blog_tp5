<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin;

class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $admin = new Admin();
            $data = input('post.');
            $num = $admin->login($data);
            if ($num == 3) {
                $this->success('登录成功,正在为您跳转', 'index/index');
            } elseif ($num == 4) {
                $this->error('验证码错误');
            } else {
                $this->error('用户名或密码错误');
            };
        }
        return $this->fetch('login');

    }


}
/*$str = 'cwyb999';//这是微信公众号名
        $str = base64_encode(base64_encode($str));
        $zjiemi = strrev($str); //获取到这个地址后放到index.html的隐藏域中
        echo $zjiemi;*/