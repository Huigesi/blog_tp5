<?php
namespace app\admin\controller;
use think\Controller;
use app\Admin\model\Article as ArticleModel;
use app\admin\controller\Base;
class Article extends Controller
{
    public function lst()
    {
    	$list = ArticleModel::paginate(3);
    	$this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {	
    	if(request()->isPost()){

			$data=[
    			'title'=>input('title'),
                'url'=>input('url'),
    			'desc'=>input('desc'),
    		];
    		$validate = \think\Loader::validate('Article');
    		if(!$validate->scene('add')->check($data)){
			   $this->error($validate->getError()); die;
			}
    		if(db('Article')->insert($data)){
    			return $this->success('添加文章成功！','lst');
    		}else{
    			return $this->error('添加文章失败！');
    		}
    		return;
    	}
        $cateres = db('cate')->select();
        $this->assign('cateres', $cateres);
        return $this->fetch();
    }

    public function edit(){
    	$id=input('id');
    	$articles=db('article')->find($id);
    	if(request()->isPost()){
    		$data=[
    			'id'=>input('id'),
                'title'=>input('title'),
                'url'=>input('url'),
    			'desc'=>input('desc'),
    		];
			$validate = \think\Loader::validate('Article');
    		if(!$validate->scene('edit')->check($data)){
			   $this->error($validate->getError()); die;
			}
    		if(db('article')->update($data)){
    			$this->success('修改文章成功！','lst');
    		}else{
    			$this->error('修改文章失败！');
    		}
    		return;
    	}
    	$this->assign('articles',$articles);
    	return $this->fetch();
    }

    public function del(){
    	$id=input('id');
		if(db('Article')->delete(input('id'))){
			$this->success('删除文章成功！','lst');
		}else{
			$this->error('删除文章失败！');
		}
    	
    }



}
