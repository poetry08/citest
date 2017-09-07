<?php
class Car_model extends CI_Model {

    public $car = array();
	
    public function __construct(){
    	parent::__construct();
    	if(empty($_SESSION['car'])){ //�ж��Ƿ�ȫ�ִ��ڹ��ﳵ����������ڣ��������ݿ��ȡ 
    		$query = $this->db->where(array('uid'=>$_SESSION['uid']))->get('car')->row_array();
    		if(!empty($query)){ //���
    			$_SESSION['car'] = unserialize($query['car']);
    		}else{
    			$_SESSION['car'] = array();
    			$this->db->insert('car',array('uid'=>$_SESSION['uid'],'car'=>serialize(array())));
    		}
       		
    	}
    	$this->car = $_SESSION['car'];
    	
    }
    
    public function add_car($data){
    	if(array_key_exists($data['goodid'],$this->car)){ //����Ѿ�������Ʒ 
    		$this->car[$data['goodid']]['qty'] = $this->car[$data['goodid']]['qty']+$data['qty'];
    	}else{
    		$this->car[$data['goodid']]= $data;
    	}
    	
    	//������Ʒ�ܼ۸�
    	$this->car[$data['goodid']]['total'] = $this->car[$data['goodid']]['qty']*$data['price'];
    	
    	if($this->car[$data['goodid']]['qty']==0){ //ɾ����Ʒ
    		unset($this->car[$data['goodid']]);
    	}
    	
    	$_SESSION['car'] = $this->car;
    	$d = array(
    		'uid'=>$_SESSION['uid'],
    		'car'=>serialize($this->car),
    	);
    	
    	//���
		$st = $this->db->update('car',$d,array('uid'=>$_SESSION['uid']));
		return $st;

    }

	public function carlist(){
		return $this->car;
	}
	

}