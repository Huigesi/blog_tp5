<?php

namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require|max:25',
        'password' => 'require',
    ];

    protected $message = [
        'username.require' => '名称不能为空',
        'username.max' => '用户名名称不得超过25位',
        'password.require' => '密码不能为空',
    ];

    protected $scene = [
        'add'  =>  ['username','password'=>'require'],
        'edit'  =>  ['username',],
    ];
}
