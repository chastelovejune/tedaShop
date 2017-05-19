<?php
//支付宝配置信息
$alipay_config['partner'] = '2088021286654831';

//收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
$alipay_config['seller_id'] = $alipay_config['partner'];

// MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
$alipay_config['key'] = 'mlylvzrznt62g5ua3bn1huh72vtlutwh';

// 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$alipay_config['notify_url'] = "localhost/create_direct_pay_by_user-PHP-UTF-82/notify_url.php";

// 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
$alipay_config['return_url'] = "localhost/create_direct_pay_by_user-PHP-UTF-82/return_url.php";

//签名方式
$alipay_config['sign_type'] = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset'] = strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert'] = getcwd().'\\cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport'] = 'http';

// 支付类型 ，无需修改
$alipay_config['payment_type'] = "1";

// 产品类型，无需修改
$alipay_config['service'] = "create_direct_pay_by_user";

//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


//↓↓↓↓↓↓↓↓↓↓ 请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

// 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
$alipay_config['anti_phishing_key'] = "";

// 客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
$alipay_config['exter_invoke_ip'] = "";

//↑↑↑↑↑↑↑↑↑↑请在这里配置防钓鱼信息，如果没开通防钓鱼功能，为空即可 ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


/*以上是支付支付配置文件*/



return array(
	//'配置项'=>'配置值'
	'DB_TYPE'     =>  'mysql',     // 数据库类型
	'DB_HOST'     =>  'localhost', // 服务器地址
	'DB_NAME'     =>  'shopcz',      // 数据库名
	'DB_USER'     =>  'root',      // 用户名
	'DB_PWD'      =>  '',    // 密码
	'DB_PORT'     =>  '3306',      // 端口
	'DB_PREFIX'   =>  'cz_',    // 数据库表前缀

	//开启调试
	'SHOW_PAGE_TRACE' => 0,
    //微信支付
    //支付宝
    'alipay'=>$alipay_config,

);