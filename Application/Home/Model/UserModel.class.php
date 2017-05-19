<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
	public function checkUser($username,$password){
		$condition['user_name'] = $username;
		$condition['password'] = md5($password);
		if ($User = $this->where($condition)->find()) {
			//成功，保存session标识，并跳转到首页
			session('User',$User);
			return true;
		} else {
			return false;
		}
	}
}