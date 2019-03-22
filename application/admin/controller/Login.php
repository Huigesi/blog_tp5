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
            if ($admin->login($data) == 1) {
                $this->error('用户不存在');
            } elseif ($admin->login($data) == 2) {
                $this->error('密码错误');
            } elseif ($admin->login($data) == 3) {
                $this->error('信息正确');
            }
        }
        return $this->fetch('login');
    }

}
