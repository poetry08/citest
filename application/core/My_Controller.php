<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		session_start();
		if(!isset($_SESSION['uid'])){
			$this->load->view('login');
			$this->load->helper('url');
			header("Location:http://".site_url('PublicC/login'));
		}
	}
	
	public function index(){
		echo "ok111";
	}
}
