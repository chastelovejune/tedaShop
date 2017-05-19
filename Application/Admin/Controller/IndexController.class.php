<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	//载入模板页面
    	$this->display();
    }

    public function top(){
    	$this->display();
    }

    public function menu(){
        $uid=session('admin')['admin_id'];
       $group= M('auth_group_access')->find($uid);
       $rules= M('auth_group')->find($group['group_id']);
       $auth= explode(',',$rules['rules']);
        $auth_rule=M('auth_rule');
        foreach($auth as $k=>$v){
           $arr[]= $auth_rule->find($v);
        }
        $this->assign('arr',$arr);
    	$this->display();
    }

    public function drag(){
    	$this->display();
    }

    public function main()
    {

    	$this->display();
    }

}