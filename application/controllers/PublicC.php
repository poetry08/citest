<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 公共类，无需登录可操作类
 */
class PublicC extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		session_start();
	}
	/**
	 * 登陆操作
	 */
	public function login(){
		$this->load->helper('url');
		if(isset($_POST['btn'])){ //判断是否为登陆操作
			if($_POST['_logintoken'] !=$_SESSION['_logintoken']){
				exit("请勿非法操作");
			}
			
			$user = _addslashes($_POST['user'], array()); //获取表单用户数据
			$this->load->database();
			$row = $this->checkuser($user); //验证用户是否合法
			if(!empty($row)){
				$_SESSION['uid']=$row->id;
				$center = site_url('Center/index');
				header('Location:http://'.$center);
				
			}
			$mes = "用户名或密码错";
		}

		//如果不是登陆操作，跳转至登陆页面
		$logintoken = "_ci".md5(time().mt_rand(1000, 9999));
		$_SESSION['_logintoken'] = $logintoken;
		
		$data = array(
			'logintoken' => $logintoken,//用于处理重复提交，及xss
			'mes' => isset($mes)?$mes:'',//
		);
		$this->load->view('PublicC/login',$data);
	}
	
	/**
	 * 验证用户是否合法
	 * @param $user
	 */
	public function checkuser($user){
		$this->load->model('User_model', 'um');
		return $this->um->check_user($user);	
	}
	
	/**
	 * 登出
	 */
	public function logout(){
		session_destroy();
		$this->load->helper('url');
		header('Location:http://'.site_url('Center/index'));
	}
}