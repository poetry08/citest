<?php
class Car_model extends CI_Model {

    public $car = array();
	
    public function __construct(){
    	parent::__construct();
    	if(empty($_SESSION['car'])){ //判断是否全局存在购物车，如果不存在，将从数据库获取 
    		$query = $this->db->where(array('uid'=>$_SESSION['uid']))->get('car')->row_array();
    		if(!empty($query)){ //如果
    			$_SESSION['car'] = unserialize($query['car']);
    		}else{
    			$_SESSION['car'] = array();
    			$this->db->insert('car',array('uid'=>$_SESSION['uid'],'car'=>serialize(array())));
    		}
       		
    	}
    	$this->car = $_SESSION['car'];
    	
    }
    
    public function add_car($data){
    	if(array_key_exists($data['goodid'],$this->car)){ //如果已经存在商品 
    		$this->car[$data['goodid']]['qty'] = $this->car[$data['goodid']]['qty']+$data['qty'];
    	}else{
    		$this->car[$data['goodid']]= $data;
    	}
    	
    	//计算商品总价格
    	$this->car[$data['goodid']]['total'] = $this->car[$data['goodid']]['qty']*$data['price'];
    	
    	if($this->car[$data['goodid']]['qty']==0){ //删除商品
    		unset($this->car[$data['goodid']]);
    	}
    	
    	$_SESSION['car'] = $this->car;
    	$d = array(
    		'uid'=>$_SESSION['uid'],
    		'car'=>serialize($this->car),
    	);
    	
    	//存库
		$st = $this->db->update('car',$d,array('uid'=>$_SESSION['uid']));
		return $st;

    }

	public function carlist(){
		return $this->car;
	}
	

}