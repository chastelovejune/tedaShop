<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{

	//构造方法
	public function __construct(){
		parent::__construct(); //一定要调用
		//获取分类，并分配到模板
		$cats = D('category')->frontCats();
		$this->assign('cats',$cats);
    	$this->assign('index',false);
		if(session('User')){
		$user=session('User');//如果登陆获取session
        $this->assign('user',$user);
        
		$condition['user_id']=$user['user_id'];
		$res=M('shopcart')->where($condition)->select();
		$num=count($res);//计算总的商品数
		$this->assign('num',$num);
    }
	}
}