<?php

namespace app\index\controller;
class Article extends Base
{
    public function index()
    {
        $articleid = input('articleid');
        $articles = db('article')->find($articleid);
        db('article')->where('id', '=', $articleid)->setInc('click');
        $cates = db('cate')->find($articles['cateid']);
        $recres = db('article')->where(array('cateid' => $cates['id'],'state'=>1))->limit(8)->select();
        $this->assign(array(
            'articles' => $articles,
            'cates' => $cates,
            'recres' => $recres
        ));
        return $this->fetch('article');
    }

}
