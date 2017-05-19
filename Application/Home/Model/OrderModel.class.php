<?php
namespace Home\Model;
use Think\Model\RelationModel;
class orderModel extends RelationModel{
	
	protected $_link = array(
		'order_goods'=>array(
			'mapping_type'      => self::BELONGS_TO ,
			'class_name'        => 'order_goods',
			 'foreign_key'      => 'order_id', 
			  'as_fields'       => 'goods_id',
			),
		);
	}