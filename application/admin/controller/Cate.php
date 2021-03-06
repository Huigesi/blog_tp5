<?php

namespace app\admin\controller;

use app\admin\model\Cate as CateModel;
use app\admin\controller\Base;

class Cate extends Base
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
            ];

            $validate = \think\Loader::validate('Cate');
            $result = $validate->scene('add')->check($data);
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }

            if (db('cate')->insert($data)) {
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
        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'catename' => input('catename'),
            ];
            $validate = \think\Loader::validate('Cate');
            $result = $validate->scene('edit')->check($data);
            if (!$validate->check($data)) {
                $this->error($validate->getError());
                die;
            }
            $save = db('cate')->update($data);
            if ($save !== false) {
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
