<?php

/**
 * 购物车
 */
class CartAction extends BaseAction {
	protected $cart;
	protected $user_id;
	protected $condition;

	protected function _initialize() {
		parent::_initialize ();
		import ( 'Cart' );
		$this->cart = new Cart ();
		$this->user_id = 1;
		$this->condition ['user_id'] = $this->user_id;
	}

	public function index() {
		$cartdata = $this->cart->contents ();
		$this->assign ( 'cartdata', $cartdata );
		parent::display ();
	}
	
	// 添加物品
	public function insert() {
		$status = $this->cart->insert ( array (
				'id' => 2,
				'name' => '燕子翩2014春季新款女装蕾丝修身显瘦连衣裙长袖弹力',
				'qty' => 2,
				'price' => 200 
		) );
		$this->assign ( 'status', $status );
		$this->display ();
	}
	
	// 更新物品
	public function update() {
		$status = $this->cart->update ( array (
				'rowid' => 'c81e728d9d4c2f636f067f89cc14862c',
				'qty' => 4 
		) );
		$this->assign ( 'status', $status );
		$this->display ();
	}
	
	// 清空物品
	public function clear() {
		$this->cart->destroy ();
		$this->redirect ( U ( 'Cart/Cart/index' ) );
	}
	
	// 物品存入数据库
	public function savetodb() {
		$cartdata = $this->cart->contents ();
		$cartContentString = serialize ( $cartdata );
		
		$cartdb = M ( 'cart' );
		$data = $cartdb->where ( $this->condition )->select ();
		if ($data) {
			// 要修改的数据对象属性赋值
			$data ['cartdata'] = $cartContentString;
			$data ['updatetime'] = time ();
			$status = $cartdb->where ( $this->condition )->save ( $data );
		} else {
			// 要修改的数据对象属性赋值
			$data ['user_id'] = $this->user_id;
			$data ['cartdata'] = $cartContentString;
			$data ['updatetime'] = time ();
			$status = $cartdb->add ( $data );
		}
		
		$this->assign ( 'status', $status );
		$this->display ();
	}
	
	// 从数据库读取物品
	public function readfromdb() {
		$cartdb = M ( 'cart' );
		$data = $cartdb->where ( $this->condition )->find ();
		
		if ($data) {
			$cartArray = unserialize ( $data ['cartdata'] );
		}
		$this->assign ( 'cartArray', $cartArray );
		$this->display ();
	}
	
	// 清空数据库购物车
	public function clearfromdb() {
		$cartdb = M ( 'cart' );
		$data = $cartdb->where ( $this->condition )->find ();
		
		if ($data) {
			$data ['cartdata'] = '';
			$cartdb->where ( $this->condition )->save ( $data );
		}
	}
}