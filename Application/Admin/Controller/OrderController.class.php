<?php
namespace Admin\Controller;
use Think\Controller;
class orderController extends BaseController {
	public  function index(){
		if(IS_POST) {
			$key=I('order_name');
			$map['order_sn']=array('like',"%$key%");
			$order = M('order')->where($map)->field('cz_order.order_sn,cz_user.user_name,cz_address.telephone,cz_order.order_status,cz_shipping.shipping_name,cz_shipping.shipping_fee,cz_payment.pay_name,cz_order.order_amount')->join('cz_user on cz_user.user_id = cz_order.user_id')->join('cz_address on cz_address.address_id = cz_order.address_id')->join('cz_shipping on cz_shipping.shipping_id = cz_order.shipping_id')->join('cz_payment on cz_payment.pay_id = cz_order.pay_id')->select();
		}else {
			//判断有没有缓存
			if(S('Sorder')){
				echo "缓存里取出来的";
				$order=S('Sorder');
			}else{
			$order = M('order')->field('cz_order.order_sn,cz_user.user_name,cz_address.telephone,cz_order.order_status,cz_shipping.shipping_name,cz_shipping.shipping_fee,cz_payment.pay_name,cz_order.order_amount')->join('cz_user on cz_user.user_id = cz_order.user_id')->join('cz_address on cz_address.address_id = cz_order.address_id')->join('cz_shipping on cz_shipping.shipping_id = cz_order.shipping_id')->join('cz_payment on cz_payment.pay_id = cz_order.pay_id')->select();
			S('Sorder',$order,60*60*12);//存一天
				echo "数据库里取出来的";
			}
		}
		$this->assign('order',$order);
		$this->display();
	}
	public function phpexcel(){
		Vendor("phpexcel.PHPExcel");//注意大小写，一定要正确
		$excel = new \PHPExcel();
//Excel表格式,这里简略写了8列
		$letter = array('A','B','C','D','E','F','F','G');
//表头数组
		$tableheader = array('订单号','姓名','联系电话','订单状态','送货方式','快递费用','支付方式','总金额');
//填充表头信息
		for($i = 0;$i < count($tableheader);$i++) {
			$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
		}
		$data=M('order')->field('cz_order.order_sn,cz_user.user_name,cz_address.telephone,cz_order.order_status,cz_shipping.shipping_name,cz_shipping.shipping_fee,cz_payment.pay_name,cz_order.order_amount')->join('cz_user on cz_user.user_id = cz_order.user_id')->join('cz_address on cz_address.address_id = cz_order.address_id')->join('cz_shipping on cz_shipping.shipping_id = cz_order.shipping_id')->join('cz_payment on cz_payment.pay_id = cz_order.pay_id')->select();
		/*$data = array(
			array('1','小王','男','20','100'),
			array('2','小李','男','20','101'),
			array('3','小张','女','20','102'),
			array('4','小赵','女','20','103')
		);*/
//填充表格信息
		for ($i = 2;$i <= count($data) + 1;$i++) {
			$j = 0;
			foreach ($data[$i - 2] as $key=>$value) {
				$excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
				$j++;
			}
		}
		$write = new \PHPExcel_Writer_Excel5($excel);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Type:application/vnd.ms-execl");
		header("Content-Type:application/octet-stream");
		header("Content-Type:application/download");;
		header('Content-Disposition:attachment;filename="order.xls"');
		header("Content-Transfer-Encoding:binary");
		$write->save('php://output');

	}
}