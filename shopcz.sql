/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : shopcz

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-08 22:31:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cz_address`
-- ----------------------------
DROP TABLE IF EXISTS `cz_address`;
CREATE TABLE `cz_address` (
  `address_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '地址编号',
  `user_name` varchar(16) NOT NULL,
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `province` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '省份，保存是ID',
  `city` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '市',
  `district` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '区',
  `street` varchar(100) NOT NULL DEFAULT '' COMMENT '街道地址',
  `zipcode` varchar(10) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `telephone` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '移动电话',
  PRIMARY KEY (`address_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_address
-- ----------------------------
INSERT INTO `cz_address` VALUES ('1', '刘定邦', '刘定邦', '2', '3', '2', '十三大街', '300457', '13612165425', '5728333');
INSERT INTO `cz_address` VALUES ('5', '刘定邦', '邦邦邦邦', '0', '0', '0', '', '', '', '');

-- ----------------------------
-- Table structure for `cz_admin`
-- ----------------------------
DROP TABLE IF EXISTS `cz_admin`;
CREATE TABLE `cz_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `admin_name` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_admin
-- ----------------------------
INSERT INTO `cz_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@itcast.cn', '0');

-- ----------------------------
-- Table structure for `cz_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `cz_attribute`;
CREATE TABLE `cz_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品属性ID',
  `attr_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品属性名称',
  `type_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '商品属性所属类型ID',
  `attr_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性是否可选 0 为唯一，1为单选，2为多选',
  `attr_input_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性录入方式 0为手工录入，1为从列表中选择，2为文本域',
  `attr_value` text COMMENT '属性的值',
  `sort_order` tinyint(4) NOT NULL DEFAULT '50' COMMENT '属性排序依据',
  PRIMARY KEY (`attr_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_attribute
-- ----------------------------

-- ----------------------------
-- Table structure for `cz_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `cz_auth_group`;
CREATE TABLE `cz_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_auth_group
-- ----------------------------
INSERT INTO `cz_auth_group` VALUES ('1', '超级管理员', '1', '1,2,3,8,9');

-- ----------------------------
-- Table structure for `cz_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `cz_auth_group_access`;
CREATE TABLE `cz_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_auth_group_access
-- ----------------------------
INSERT INTO `cz_auth_group_access` VALUES ('1', '1');

-- ----------------------------
-- Table structure for `cz_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `cz_auth_rule`;
CREATE TABLE `cz_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_auth_rule
-- ----------------------------
INSERT INTO `cz_auth_rule` VALUES ('1', 'Admin/Index/Index', '后台首页', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('2', 'Admin/login/login', '登录', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('3', 'Admin/Category/index', '商品分类', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('4', 'Admin/Brand/index', '商品品牌', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('5', 'Admin/Type/index', '商品类型', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('6', 'Admin/Goods/add', '商品添加', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('7', 'Admin/Goods/index', '商品列表', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('8', 'Admin/Order/index', '订单列表', '1', '1', '');
INSERT INTO `cz_auth_rule` VALUES ('9', 'Admin/Order/phpexcel', '导出功能', '1', '1', '');

-- ----------------------------
-- Table structure for `cz_brand`
-- ----------------------------
DROP TABLE IF EXISTS `cz_brand`;
CREATE TABLE `cz_brand` (
  `brand_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品品牌ID',
  `brand_name` varchar(30) NOT NULL DEFAULT '' COMMENT '商品品牌名称',
  `brand_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '商品品牌描述',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '商品品牌网址',
  `logo` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌logo',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '商品品牌排序依据',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示，默认显示',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_brand
-- ----------------------------
INSERT INTO `cz_brand` VALUES ('1', '小米', '', 'www.xiaomi.com', '', '50', '1');
INSERT INTO `cz_brand` VALUES ('2', '苹果', '', 'www.apple.com', '', '50', '1');
INSERT INTO `cz_brand` VALUES ('3', '耐克', '', 'www.nike.com', './Public/Uploads/2016-04-13/570d8ccc4ec57.gif', '50', '1');

-- ----------------------------
-- Table structure for `cz_category`
-- ----------------------------
DROP TABLE IF EXISTS `cz_category`;
CREATE TABLE `cz_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类别ID',
  `cat_name` varchar(30) NOT NULL DEFAULT '' COMMENT '商品类别名称',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品类别父ID',
  `cat_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '商品类别描述',
  `sort_order` tinyint(4) NOT NULL DEFAULT '50' COMMENT '排序依据',
  `unit` varchar(15) NOT NULL DEFAULT '' COMMENT '单位',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示，默认显示',
  PRIMARY KEY (`cat_id`),
  KEY `pid` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_category
-- ----------------------------
INSERT INTO `cz_category` VALUES ('1', '手机', '0', '', '1', '台', '1');
INSERT INTO `cz_category` VALUES ('2', '小米手机', '1', '', '2', '台', '1');
INSERT INTO `cz_category` VALUES ('5', '男女服装', '0', '', '3', '台', '1');
INSERT INTO `cz_category` VALUES ('4', '华为', '1', '', '50', '台', '1');
INSERT INTO `cz_category` VALUES ('6', '裙子', '5', '', '5', '', '1');
INSERT INTO `cz_category` VALUES ('7', '连衣裙', '6', '', '50', '件', '1');
INSERT INTO `cz_category` VALUES ('8', '电脑、办公', '0', '', '50', '台', '1');
INSERT INTO `cz_category` VALUES ('9', '家居、家具、家装、厨具', '0', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('10', '汽车，汽车用品', '0', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('11', '母婴、玩具乐器', '0', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('12', '食品、酒类，生鲜、特产', '0', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('13', '个人化妆、清洁用品', '0', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('14', '鞋子、箱包、钟表、奢侈品', '0', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('15', '男装', '5', '', '50', '件', '1');
INSERT INTO `cz_category` VALUES ('16', '女装', '5', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('17', '棉衣', '16', '', '50', '', '1');
INSERT INTO `cz_category` VALUES ('18', '大衣', '16', '', '50', '', '1');

-- ----------------------------
-- Table structure for `cz_galary`
-- ----------------------------
DROP TABLE IF EXISTS `cz_galary`;
CREATE TABLE `cz_galary` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片编号',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `img_url` varchar(50) NOT NULL DEFAULT '' COMMENT '图片URL',
  `thumb_url` varchar(50) NOT NULL DEFAULT '' COMMENT '缩略图URL',
  `img_desc` varchar(50) NOT NULL DEFAULT '' COMMENT '图片描述',
  PRIMARY KEY (`img_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_galary
-- ----------------------------

-- ----------------------------
-- Table structure for `cz_goods`
-- ----------------------------
DROP TABLE IF EXISTS `cz_goods`;
CREATE TABLE `cz_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `goods_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_brief` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简单描述',
  `goods_desc` text COMMENT '商品详情',
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属类别ID',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属品牌ID',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `promote_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销起始时间',
  `promote_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销截止时间',
  `goods_img` varchar(50) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_thumb` varchar(50) NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `click_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型ID',
  `is_promote` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否促销，默认为0不促销',
  `is_best` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否精品,默认为0',
  `is_new` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品，默认为0',
  `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否热卖,默认为0',
  `is_onsale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架,默认为1',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`goods_id`),
  KEY `cat_id` (`cat_id`),
  KEY `brand_id` (`brand_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_goods
-- ----------------------------
INSERT INTO `cz_goods` VALUES ('4', 'ecs0032', '小米NOTE', '', '小米note还不错的', '2', '1', '1499.00', '1499.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-09/5708d63856516.jpg', '', '5', '5', '1', '0', '1', '0', '0', '1', '1460196920');
INSERT INTO `cz_goods` VALUES ('5', 'ecs0032', '小米5', '', '小米NOTE还是不错的', '2', '1', '1999.00', '1999.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-09/5708d69587c48.jpg', '', '4', '4', '1', '0', '0', '1', '0', '1', '1460197013');
INSERT INTO `cz_goods` VALUES ('6', '001', '诺基亚平板', '', '&lt;p&gt;&amp;nbsp;平板电脑还不错&lt;/p&gt;', '8', '0', '1000.00', '1000.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-09/5708d6d76f7a7.jpg', '', '4', '1', '0', '0', '0', '0', '1', '1', '1460197079');
INSERT INTO `cz_goods` VALUES ('7', '', '小米2', '', '', '0', '0', '10000.00', '1000.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-09/5708f9ed214cc.jpg', '', '4', '1', '1', '0', '1', '1', '1', '1', '1460206061');
INSERT INTO `cz_goods` VALUES ('8', 'ECS00001', '短裙', '', '&lt;p&gt;&amp;nbsp;还不错的衣服&lt;/p&gt;', '18', '3', '180.00', '180.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '', '4', '0', '0', '0', '1', '1', '1', '1', '1460505905');
INSERT INTO `cz_goods` VALUES ('9', 'ECS00002', '大衣', '', '&lt;p&gt;&amp;nbsp;还不错&lt;/p&gt;', '16', '3', '200.00', '200.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-13/570d8dbd906f8.jpg', '', '4', '0', '0', '0', '0', '0', '1', '1', '1460506045');
INSERT INTO `cz_goods` VALUES ('10', 'exs2r424', '女生牛仔裤', '', '', '16', '3', '90.00', '90.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-13/570da08c41f92.jpg', '', '4', '0', '0', '0', '0', '0', '0', '1', '1460510860');
INSERT INTO `cz_goods` VALUES ('11', 'ecs00006', '衬衫', '', '', '20', '0', '80.00', '80.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-13/570da0ceaeff2.jpg', '', '4', '0', '0', '0', '0', '0', '0', '1', '1460510926');
INSERT INTO `cz_goods` VALUES ('12', 'ECS0007', '外套', '', '', '15', '0', '200.00', '200.00', '0.00', '1243785600', '0', './Public/Uploads/2016-04-13/570da137e3180.jpg', '', '4', '0', '0', '0', '0', '0', '0', '1', '1460511031');

-- ----------------------------
-- Table structure for `cz_goods_attr`
-- ----------------------------
DROP TABLE IF EXISTS `cz_goods_attr`;
CREATE TABLE `cz_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号ID',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '属性ID',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性价格',
  PRIMARY KEY (`goods_attr_id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for `cz_goods_type`
-- ----------------------------
DROP TABLE IF EXISTS `cz_goods_type`;
CREATE TABLE `cz_goods_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类型ID',
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_goods_type
-- ----------------------------
INSERT INTO `cz_goods_type` VALUES ('1', '手机');

-- ----------------------------
-- Table structure for `cz_order`
-- ----------------------------
DROP TABLE IF EXISTS `cz_order`;
CREATE TABLE `cz_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `address_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收货地址id',
  `order_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态 1 待付款 2 待发货 3 已发货 4 已完成',
  `postscripts` varchar(255) NOT NULL DEFAULT '' COMMENT '订单附言',
  `shipping_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '送货方式ID',
  `pay_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付方式ID',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总金额',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `order_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单时间',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `address_id` (`address_id`),
  KEY `pay_id` (`pay_id`),
  KEY `shipping_id` (`shipping_id`)
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_order
-- ----------------------------
INSERT INTO `cz_order` VALUES ('227', '1468315736', '1', '1', '0', ',,,,', '1', '2', '1679.00', '1689.00', '0');
INSERT INTO `cz_order` VALUES ('226', '1465276048', '1', '1', '0', 'e e ', '1', '1', '1679.00', '1689.00', '0');
INSERT INTO `cz_order` VALUES ('225', '1465226111', '1', '1', '0', 'w', '1', '1', '180.00', '190.00', '0');
INSERT INTO `cz_order` VALUES ('224', '1465175918', '1', '1', '0', '', '1', '1', '180.00', '190.00', '0');
INSERT INTO `cz_order` VALUES ('223', '1465023223', '1', '1', '0', '', '1', '1', '360.00', '370.00', '0');
INSERT INTO `cz_order` VALUES ('222', '1464936527', '1', '1', '0', '很好', '1', '2', '180.00', '190.00', '0');
INSERT INTO `cz_order` VALUES ('221', '1464763410', '1', '1', '0', 'hen hao ', '1', '2', '2179.00', '2189.00', '0');

-- ----------------------------
-- Table structure for `cz_order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `cz_order_goods`;
CREATE TABLE `cz_order_goods` (
  `rec_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_img` varchar(50) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_num` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '购买数量',
  `goods_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品小计',
  PRIMARY KEY (`rec_id`)
) ENGINE=MyISAM AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_order_goods
-- ----------------------------
INSERT INTO `cz_order_goods` VALUES ('141', '', '4', '小米NOTE', './Public/Uploads/2016-04-09/5708d63856516.jpg', '1499.00', '1', '', '1499.00');
INSERT INTO `cz_order_goods` VALUES ('140', '', '8', '短裙', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '180.00', '1', '', '180.00');
INSERT INTO `cz_order_goods` VALUES ('139', '', '4', '小米NOTE', './Public/Uploads/2016-04-09/5708d63856516.jpg', '1499.00', '1', '', '1499.00');
INSERT INTO `cz_order_goods` VALUES ('138', '', '8', '短裙', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '180.00', '1', '', '180.00');
INSERT INTO `cz_order_goods` VALUES ('137', '', '8', '短裙', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '180.00', '1', '', '180.00');
INSERT INTO `cz_order_goods` VALUES ('136', '', '8', '短裙', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '180.00', '1', '', '180.00');
INSERT INTO `cz_order_goods` VALUES ('135', '', '8', '短裙', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '180.00', '2', '', '360.00');
INSERT INTO `cz_order_goods` VALUES ('134', '', '8', '短裙', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '180.00', '1', '', '180.00');
INSERT INTO `cz_order_goods` VALUES ('132', '', '8', '短裙', './Public/Uploads/2016-04-13/570d8d318a3e6.jpg', '180.00', '1', '', '180.00');
INSERT INTO `cz_order_goods` VALUES ('133', '', '5', '小米5', './Public/Uploads/2016-04-09/5708d69587c48.jpg', '1999.00', '1', '', '1999.00');

-- ----------------------------
-- Table structure for `cz_payment`
-- ----------------------------
DROP TABLE IF EXISTS `cz_payment`;
CREATE TABLE `cz_payment` (
  `pay_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '支付方式ID',
  `pay_name` varchar(30) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  `pay_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '支付方式描述',
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用，默认启用',
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_payment
-- ----------------------------
INSERT INTO `cz_payment` VALUES ('1', '支付宝', '支付宝公司提供的支付功能', '1');
INSERT INTO `cz_payment` VALUES ('2', '微信支付', '腾讯公司提供的支付功能', '1');
INSERT INTO `cz_payment` VALUES ('3', '银联', '中国银联支付', '1');
INSERT INTO `cz_payment` VALUES ('4', '首信易支付', '首信易支付功能', '1');

-- ----------------------------
-- Table structure for `cz_region`
-- ----------------------------
DROP TABLE IF EXISTS `cz_region`;
CREATE TABLE `cz_region` (
  `region_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '地区ID',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `region_name` varchar(30) NOT NULL DEFAULT '' COMMENT '地区名称',
  `region_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '地区类型 1 省份 2 市 3 区(县)',
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_region
-- ----------------------------

-- ----------------------------
-- Table structure for `cz_shipping`
-- ----------------------------
DROP TABLE IF EXISTS `cz_shipping`;
CREATE TABLE `cz_shipping` (
  `shipping_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `shipping_name` varchar(30) NOT NULL DEFAULT '' COMMENT '送货方式名称',
  `shipping_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '送货方式描述',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '送货费用',
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用，默认启用',
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_shipping
-- ----------------------------
INSERT INTO `cz_shipping` VALUES ('1', '申通', '申通快递', '10.00', '1');
INSERT INTO `cz_shipping` VALUES ('2', '平邮', '平邮速度稍微有点慢', '5.00', '1');
INSERT INTO `cz_shipping` VALUES ('3', '韵达', '韵达快递', '15.00', '1');
INSERT INTO `cz_shipping` VALUES ('4', '中通', '中通快递', '15.00', '1');

-- ----------------------------
-- Table structure for `cz_shopcart`
-- ----------------------------
DROP TABLE IF EXISTS `cz_shopcart`;
CREATE TABLE `cz_shopcart` (
  `cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_img` varchar(50) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性',
  `goods_num` int(5) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成交价格',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '小计',
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_shopcart
-- ----------------------------
INSERT INTO `cz_shopcart` VALUES ('15', '1', '8', '', '', '', '1', '0.00', '180.00', '180.00');
INSERT INTO `cz_shopcart` VALUES ('16', '2', '8', '', '', '', '1', '0.00', '180.00', '180.00');
INSERT INTO `cz_shopcart` VALUES ('21', '1', '4', '', '', '', '1', '0.00', '1499.00', '1499.00');

-- ----------------------------
-- Table structure for `cz_user`
-- ----------------------------
DROP TABLE IF EXISTS `cz_user`;
CREATE TABLE `cz_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码,md5加密',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户注册时间',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cz_user
-- ----------------------------
INSERT INTO `cz_user` VALUES ('1', '刘定邦', '605780722@qq.com', '864ce000907148c15695d87a552dcf5e', '0');
INSERT INTO `cz_user` VALUES ('2', '张三', '123@qq.com', '864ce000907148c15695d87a552dcf5e', '0');
