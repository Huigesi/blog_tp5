<?php

namespace app\admin\model;
use think\Db;
use think\Model;

class Admin extends Model
{
    public function login($data)
    {
        $user = Db::name('admin')->where('username','=',$data['username'])->find();
        if ($user) {
            if ($user['password']==md5($data['password'])) {
                return 3;//信息正确；
            } else {
                return 2;//密码错误
            }
        }else{
            return 1;//用户名不存在
        }
    }
}
