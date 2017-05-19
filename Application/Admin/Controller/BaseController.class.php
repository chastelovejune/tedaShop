<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class BaseController extends Controller {
	//构造方法
	public function __construct(){
		parent::__construct(); //一定要调用父类的构造方法
		import('ORG.Util.Auth');//加载类库
		$this->checkLogin();
		$auth= new Auth();
		//去除基础菜单显示
		if(ACTION_NAME==top||ACTION_NAME==menu||ACTION_NAME==drag||ACTION_NAME==main){
			return true;
		}
		if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,session('admin')['admin_id'])){
			$this->error('无权限访问');
			//echo "无权限访问";
		}
	}
	//验证是否登录
	public function checkLogin(){
		//通过session来验证
		if (!$_SESSION['admin']) {
			//没有登录
			$this->error('请先登录吧',U('Login/login'));
		}
	}
}