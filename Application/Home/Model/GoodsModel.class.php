<?php
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model{

	//获取推荐商品
	public function getBestGoods(){
		$condition['is_best'] = 1;
		$condition['is_onsale'] = 1;
		return $this->where($condition)->order('goods_id desc')->limit(4)->select();
	}
	//获得热销商品
	public function getHotGoods(){
		$condition['is_hot'] = 1;
		$condition['is_hot'] = 1;
		return $this->where($condition)->order('goods_id desc')->limit(4)->select();

	}
	//获得新商品
	public function getNewGoods(){
		$condition['is_new'] = 1;
		$condition['is_new'] = 1;
		return $this->where($condition)->order('goods_id desc')->limit(4)->select();
}
//获得男女服装
	public function getClothes(){

		$map['cat_id']=array('GT',15);

		return $this->where($map)->order('goods_id desc')->limit(6)->select();

}
}