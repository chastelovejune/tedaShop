<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
     session_start();
      session(array('name'=>'session_id','expire'=>3600));
}