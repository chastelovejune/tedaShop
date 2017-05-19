<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ShopModel extends RelationModel{
	
	protected $_link = array(
		'relation2'=>array(
			'mapping_type'      => self::BELONGS_TO ,
			'class_name'        => 'order_goods',
			 'foreign_key'      => 'order_sn', 
			),
		);
	}