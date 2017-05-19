<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends BaseController {
   //显示登录页面并验证
	public function index(){
		
		if (IS_POST) {
		
			//获取验证码、用户名和密码
			$username = I('username');
			$password = I('password');
			$captcha = I('captcha');
			//验证,注意顺序
			//先检查验证码
			
			$verify = new \Think\Verify();
			if (!$verify->check($captcha)){
				$this->ajaxreturn('验证码错误，请刷新验证码再试！');
			}
			
			//再来检查用户名和密码,调用模型来完成
			if (D('User')->checkUser($username,$password)) {
				$this->ajaxreturn('1');
			} else {
				$this->ajaxreturn('用户名或密码错误');
			}
			return;
		} 

		// 载入登录页面
		$this->display();
	}

	//生成验证码
	public function code(){
		// 使用tp自带的验证码类
		$Verify = new \Think\Verify();
		$Verify->entry();
	}

	//注销
	public function logout(){
		session('[destroy]'); // 销毁session
		$this->success('注销成功',U('index/index'),1);
	}
	public function register(){
		if(IS_POST){
			$data['user_name'] = I('username');
			$password = I('password');
			$data['password']=md5($password);
			$captcha = I('captcha');
			$data['email']=I('email');
				//检查验证码
		$verify = new \Think\Verify();
			if (!$verify->check($captcha)){
				$this->error('验证码错误');
			}
		if(M('user')->create())
			{
				if(M('user')->add($data))
				{
				$this->success('注册成功',U('index'));
			}else{
				$this->error('注册失败',U('index'));
			}
		}
			return;
		}
	
		$this->display();
	}
	public function password_eidt()
	{
		$this->display();
	}
}
