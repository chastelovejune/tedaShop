<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    //	$redis = new \Redis();
	//$redis->connect('127.0.0.1',6379);
	//$redis->set('test','hello redis');
	//echo $redis->get('test');

    	//获取推荐商品
    	$bestGoods = D('goods')->getBestGoods();
    	$this->assign('bestGoods',$bestGoods);
        //获得热销商品
        $hotGoods = D('goods')->getHotGoods();
        $this->assign('hotGoods',$hotGoods);
        //获得新品
        $newGoods = D('goods')->getNewGoods();
        $this->assign('newGoods',$newGoods);
        //获得衣服
        $Clothes=D('goods')->getClothes();
        $this->assign('Clothes',$Clothes);
    /*
        获取分类模块start
     */
        //获得女装分类信息
        $girlGoods=M('category')->where('parent_id=16')->limit(6)->select();
        //获取男装信息
        $boyGoods=M('category')->where('parent_id=15')->limit(6)->select();
        $this->assign('girlGoods',$girlGoods);
        $this->assign('boyGoods',$boyGoods);
    /*
    获取分类模块end
    */
      /*根据商品点击数，画出商品拍行*/
        $goodsDesc=M('goods')->order('click_count desc')->limit(5)->select();
        $this->assign('goodsDesc',$goodsDesc);
 
        //判断是否为主页，默认设置为true
    	$this->assign('index',true);
    	$this->display();
    }
}