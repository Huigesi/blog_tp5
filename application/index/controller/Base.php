<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize()
    {
        $cateres = db('cate')->order('id asc')->select();
        $this->assign('cateres', $cateres);
    }
}
