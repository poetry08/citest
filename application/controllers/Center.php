<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 个人中心 
 */
class Center extends My_Controller{
	public $goodslist = array( //用于商品列表 
		array('goodid'=>1001,'name'=>'商品1','price'=>10.5,'store'=>10),
		array('goodid'=>1002,'name'=>'商品2','price'=>100.5,'store'=>3),
		array('goodid'=>1003,'name'=>'商品3','price'=>60.5,'store'=>6),
	);
	
	public $glsort = array(//用于购物车取价格
		'1001'=>array('name'=>'商品1','price'=>10.5,'store'=>10),
		'1002'=>array('name'=>'商品2','price'=>100.5,'store'=>3),
		'1003'=>array('name'=>'商品3','price'=>60.5,'store'=>6),
	);
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
	}
	/**
	 * 个人中心首页
	 */
	public function index(){
		$this->load->view('Center/index');
		$this->load->view('Center/footer');
	}
	
	/**
	 * 商品列表
	 */
	public function goodslist(){
		$data = array(
			'goodslist'=>$this->goodslist,
		);
		$this->load->view('Center/goodslist',$data);
		$this->load->view('Center/footer');
	}
	
	/**
	 * 购物车
	 */
	public function addcar(){
		$goodid = isset($_POST['goodid'])?$_POST['goodid']:'0';
		$qty = isset($_POST['qty'])?$_POST['qty']:'0';

		if(empty($goodid) || empty($qty)){
			exit("请勿非法操作");
		}
		
		$data = array(
		    'uid'      => $_SESSION['uid'],
			'goodid'  => $goodid,
		    'qty'     => $qty,
		    'name'    => $this->glsort[$goodid]['name'],
  			'price'   => $this->glsort[$goodid]['price'],
			'store'   => $this->glsort[$goodid]['store'],
		    'options' => array('Size' => 'M', 'Color' => '绿色'),
			'time'=>time(),
		);

		$this->load->model('Car_model','car');
		echo $this->car->add_car($data);

	}
	
	
	public function carlist(){
		$this->load->model('Car_model','car');
		$carlist = $this->car->carlist();
		
		$data = array(
			'carlist'=>$carlist,
		);
		$this->load->view('Center/carlist',$data);
		$this->load->view('Center/footer');
	}
	
	public function getcarlist(){
		$this->load->model('Car_model','car');
		$carlist = $this->car->carlist();
		
//		$data = array(
//			'carlist'=>$carlist,
//		);
		echo json_encode($carlist);
	}
	
}