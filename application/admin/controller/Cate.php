<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model\Cate as CateModel;
use think\Request;

class Cate extends Controller
{
    public function lst()
    {
        $list = CateModel::paginate(3);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'catename' => input('catename'),
                //'password' => (input('password')),
            ];

            $validate = \think\Loader::validate('Cate');
            $result = $validate->scene('add')->check($data);
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }

            if (Db::name('cate')->insert($data)) {
                return $this->success("添加栏目成功", 'lst');
            } else {
                return $this->error("添加栏目失败");
            }

            return;
        }
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $cates = db('cate')->find($id);
        $data = [
            'id' => input('id'),
            'username' => input('username'),
        ];
        if (input('password')) {
            $data['password'] = md5(input('password'));
        } else {
            $data['password'] = $cates['password'];
        }
        $validate = \think\Loader::validate('Cate');
        $result = $validate->scene('edit')->check($data);
        if (!$validate->check($data)) {
            $this->error($validate->getError());
            die;
        }
        if (request()->isPost()) {
            if (db('cate')->update($data)) {
                $this->success("修改栏目信息成功", "lst");
            } else {
                $this->error("修改栏目信息失败");
            }
            return;
        }
        //dump($admins);
        $this->assign('cates', $cates);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        if ($id != 2) {
            if (db('cate')->delete($id)) {
                $this->success("删除栏目成功");
            } else {
                $this->error("删除栏目失败");
            }
        } else {
            $this->error("初始栏目不得删除");
        }
    }
}
