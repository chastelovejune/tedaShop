<?php
namespace Home\Controller;
use Think\Controller;
class CategoryController extends BaseController {

	public function index($id){
		$cat_id = I('id',0,'int');
		//面包屑导航
		//获取当前分类下(包括后代所有)所有的商品
		$parentCats = D('category')->getParents($cat_id);
		$goods=M('goods')->where('cat_id='.$id)->select();
		$this->assign('parentCats',$parentCats);
		$this->assign('goods',$goods);
	
		/*取出热卖商品*/
		$hotGoods=M('goods')->where('is_hot=1')->limit(5)->select();
		$this->assign('hotGoods',$hotGoods);
		$this->display();
		
		

	}
}