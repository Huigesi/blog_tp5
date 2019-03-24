<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        $this->right();
        $cateres = db('cate')->order('id asc')->select();
        $tags = db('tags')->order('id asc')->select();
        $this->assign(array(
            'cateres'=>$cateres,
            'tags'=>$tags
        ));
    }

    public function right()
    {
        $clickres = db('article')->order('click desc')->limit(8)->select();
        $tjres = db('article')->where('state', '=', 1)->order('click desc')->limit(8)->select();
        $this->assign(array(
            'clickres' => $clickres,
            'tjres' => $tjres
        ));
    }
}
