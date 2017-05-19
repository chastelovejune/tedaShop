<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends BaseController{
	//显示购物车主页
	public function index()
{ 

	if(session('User')){
			$this->display();
	}else{
		$this->error('你还没登录呢',U('index/index',0));
	}
	}


	//显示购物车
	public function shopCar()
	{
		if(session('User')){
			$User=session('User');
			$condition['user_id']=$User['user_id'];
			$res=M('shopcart')->join('cz_goods ON cz_goods.goods_id = cz_shopcart.goods_id')->where($condition)->select();
			
			  //计算总费用
        $total=M('shopcart')->sum('subtotal');
        $this->assign('total',$total);
        $this->assign('goodsRes',$res);	
		$this->display();
	}else{
		$this->error('你还没登录呢',U('index/index',0));
	}
	}
//购物车第二步，选择送货地址
	public function shopCar2()
	{
		if(session('User')){
			//如果提交表单,存入收货地址
			if(IS_POST)
			{
			  $array=session('User');
		
		      $data['user_name']=$array['user_name'];//用户名作为唯一标识
              $data['consignee']=I('consignee');
              $data['province']=I('province');
              $data['city']=I('city');
              $data['district']=I('district');
              $data['street']=I('street');
              $data['zipcode']=I('zipcode');
              $data['mobile']=I('mobile');
            
            M('address')->data($data)->add();
        }
          
        //取出原有收货地址
        $array=session('User');
        $condition['user_name']=$array['user_name'];
        $res=M('address')->where($condition)->select();
        $this->assign('res',$res);
      

        
        //取出购物车商品
        
			$user_id=$array['user_id'];
			$Res=M('shopcart')->field('cz_goods.goods_id,cz_goods.goods_name,cz_goods.goods_img,cz_goods.shop_price,cz_shopcart.goods_num,cz_shopcart.goods_price,cz_shopcart.subtotal')->join('cz_goods ON cz_goods.goods_id = cz_shopcart.goods_id')->where('user_id='.$user_id)->select();
     
	   //取出送货方式
    

          //foreach ($Res as $key => $value){
             // $data['$key']=$value;
              // dump($data['$key']);
               //M('order_goods')->add($data['$key']);

              
           // }
           

   
			$shipping=M('shipping')->select();
	    // 取出支付方式
			$payment=M('payment')->select();
      //计算总费用
      $total=M('shopcart')->where('user_id='.$user_id)->sum('subtotal');



			  $this->assign('total',$total);
        $this->assign('goodsRes',$Res);
        $this->assign('shipping',$shipping);
        $this->assign('payment',$payment);
        

		
		$this->display();
	}else{
		$this->error('你还没登录呢',U('index/index',0));
	}
	}






	/* 点击加入购物车 */
	
	public function addcart()

	{
		if(session('User')){
			$User=session('User');
			if(IS_POST){
				$data['user_id']=$User['user_id'];
				$data['goods_id']=I('goods_id');
				$data['goods_num']=I('goods_num');
        $data['goods_price']=I('goods_price');
        $data['subtotal']=$data['goods_num']*$data['goods_price'];	

				if(M('shopcart')->where($data)->select())
				{
					$this->success('此商品已经在购物车中啦!!');
				}
				else{
					M('shopcart')->add($data);
					$this->success('加入购物车成功');
				}
			}			
	}else{
		$this->error('你还没登录呢',U('index/index',0));
	}

	}
	/*管理收货地址*/
  public function address()
  {
    if(session('User')){
        $array=session('User');
        $condition['user_name']=$array['user_name'];
        $address=M('address')->where($condition)->select();
        $this->assign('address',$address);
      
    }
  
  	$this->display();
  }



  /*

             生成订单，显示在个人中心

  */
  public function order()
  {
  	//生成订单
  	
  	if(session('User')){
  		//如果提交订单
  		if(IS_POST){
  			$data['address_id']=I('address');// 数据库对应字段 4
  			$shipping_id=I('shipping');//数据库对应字段 7
            $data['shipping_id']=$shipping_id;
  			$data['pay_id']=I('payment');//数据库对应字段 8
  			$data['postscripts']=I('liuyan');//数据库对应字段 
            $data['order_sn']=time();;//生成订单ID 数据库对应字段 2
            $order_sn_query=$data['order_sn'];
  		}                               /*取出购物车里的商品组合成订单*/
        $array=session('User');
        $user_id=$array['user_id'];//数据库对应字段 3
        $data['user_id']=$user_id;
        $goods_amount=M('shopcart')->where('user_id='.$user_id)->sum('subtotal');//数据库对应字段9
        $data['goods_amount']=$goods_amount;
        $order_amount=M('shipping')->field('shipping_fee')->where('shipping_id='.$shipping_id)->find();
        $data['order_amount']=$order_amount['shipping_fee']+$goods_amount;//数据库对应字段10
      if(!$data==''){
                M()->startTrans();
          if(D('order')->relation("relation2")->add($data)){
           // unset($data);//释放以上data
            $Res=M('shopcart')->field('cz_goods.goods_id,cz_goods.goods_name,cz_goods.goods_img,cz_shopcart.goods_num,cz_shopcart.goods_price,cz_shopcart.subtotal')->join('cz_goods ON cz_goods.goods_id = cz_shopcart.goods_id')->where('user_id='.$user_id)->select();
              foreach ($Res as $key => $value){
                  $value['order_sn']=$order_sn_query;
                    $d[]=$value;
           }
              if(M('order_goods')->addAll($d)){
                 if($data['pay_id']==1){
                     $this->alipay($data);
                     return;
                 }
                 if($data['pay_id']==2){
                     $this->Wxpay($data);
                     return;
                 }
              }
              M()->comment();
              $this->error("生成订单失败，如涉及金融，请不要关闭界面，与管理员联系");
        }else{
          $this->error("生成订单失败，如涉及金融，请不要关闭界面，与管理员联系");
        }
     }
        	
  }else{
  	$this->error('你还没登录呢',U('index/index',0));
  }
  }
/*微信支付*/
public function Wxpay($data){
    Vendor('weixinpay.lib.WxPay#Api');
    Vendor('weixinpay.lib.WxPay#Notify');
    Vendor('weixinpay.lib.WxPay#NativePay');
    $notify = new \NativePay();
    $url1 = $notify->GetPrePayUrl($data['order_sn']);
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("泰达小点订单");
        $input->SetAttach("泰达小点");
        $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($data['order_amount']*100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("泰达");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($data['order_sn']);
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        $this->QRcode($url2);
       // echo '<img alt="模式二扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data='.urlencode($url1).'" style="width:150px;height:150px;"/>';
}
//生成支付二维码
public function QRcode($url2){
    $data['url']="http://paysdk.weixin.qq.com/example/qrcode.php?data=".urlencode($url2);
    $data['status']=1;
    echo '<img alt="模式二扫码支付" src="'.$data['url'].'" style="width:150px;height:150px;"/>';
}
//支付宝支付
public function Alipay($data){
    Vendor('alipay.alipay_submit#class');
    Vendor('alipay.alipay#config');
    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = $data['order_sn'];
    //订单名称，必填
    $subject = '泰达小点订单';
    //付款金额，必填
    $total_fee = $data['order_amount'];
    //商品描述，可空
    $body = $data['postscripts'];
    $alipay_config=C('alipay');
//构造要请求的参数数组，无需改动
$parameter = array(
    "service"       => $alipay_config['service'],
    "partner"       => $alipay_config['partner'],
    "seller_id"  => $alipay_config['seller_id'],
    "payment_type"	=> $alipay_config['payment_type'],
    "notify_url"	=> $alipay_config['notify_url'],
    "return_url"	=> $alipay_config['return_url'],

    "anti_phishing_key"=>$alipay_config['anti_phishing_key'],
    "exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
    "out_trade_no"	=> $out_trade_no,
    "subject"	=> $subject,
    "total_fee"	=> $total_fee,
    "body"	=> $body,
    "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
    //其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
    //如"参数名"=>"参数值"

);

//建立请求
$alipaySubmit = new \AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
echo $html_text;
}

  /*删除购物车的商品*/
  public function delete($goods_id){

  	if(session('User')){

  		if(M('shopcart')->where('goods_id='.$goods_id)->delete())

  			$this->success('删除成功',U('Shop/shopcar2'));
  	}else{
  		$this->error('你还没登录呢',U('index/index',0));
  	}
  }
  //点击-+商品增加和减少
  public function add(){
    $goods_id=I('goods_id');
  	if(session('User')){
         if(M('shopcart')->where('goods_id='.$goods_id)->setInc('goods_num',1)){
          $res=M('shopcart')->field('goods_num,goods_price')->where('goods_id='.$goods_id)->select();
          $data['subtotal']=$res[0]['goods_num']*$res[0]['goods_price'];
          M('shopcart')->where('goods_id='.$goods_id)->save($data);

         	
         }
        
  }else{
  	 $this->error('你还没登录呢',U('index/index',0));
  }

  }
  public function minus(){
     $goods_id=I('goods_id');
  		if(session('User')){
         if(M('shopcart')->where('goods_id='.$goods_id)->setDec('goods_num',1)){
          $res=M('shopcart')->field('goods_num,goods_price')->where('goods_id='.$goods_id)->select();
          $data['subtotal']=$res[0]['goods_num']*$res[0]['goods_price'];
          M('shopcart')->where('goods_id='.$goods_id)->save($data);

         }
        
  }else{
  	 $this->error('你还没登录呢',U('index/index',0));
  }
  }
  //点击商品收藏
  public function collect($goods_id){
    if(session('User')){
      $User=session('User');
      $data["goods_id"]=$goods_id;
      $data['user_id']=$User['user_id'];
      if(M('collect')->where($data)->select()){
        $this->success('你已经收藏过此商品！');
      }else{
        M('collect')->add($data);
         $this->success('收藏成功');
      }

    }else{
      $this->error('你还没登录呢',U('index/index',0));

    }
  }
}