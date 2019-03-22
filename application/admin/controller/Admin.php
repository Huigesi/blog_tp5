<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model\Admin as AdminModel;
use think\Request;

class Admin extends Controller
{
    public function lst()
    {
        $list = AdminModel::paginate(3);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'username' => input('username'),
                'password' => md5(input('password')),
                //'password' => (input('password')),
            ];

            $validate = \think\Loader::validate('User');
            $result = $validate->scene('add')->check($data);
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }

            if (Db::name('admin')->insert($data)) {
                return $this->success("添加管理员成功", 'lst');
            } else {
                return $this->error("添加管理员失败");
            }

            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $admins = db('admin')->find($id);
        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'username' => input('username'),
            ];
            if (input('password')) {
                $data['password'] = md5(input('password'));
            } else {
                $data['password'] = $admins['password'];
            }
            $validate = \think\Loader::validate('User');
            $result = $validate->scene('edit')->check($data);
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }
            $save = db('admin')->update($data);
            if ($save!==false) {
                $this->success("修改管理员信息成功", "lst");
            } else {
                $this->error("修改管理员信息失败");
            }
            return;
        }
        //dump($admins);
        $this->assign('admins', $admins);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        if ($id != 2) {
            if (db('admin')->delete($id)) {
                $this->success("删除管理员成功");
            } else {
                $this->error("删除管理员失败");
            }
        } else {
            $this->error("初始管理员不得删除");
        }
    }
}
