<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller{
	
    public function __construct(){
    	parent::__construct();
        $this->load->database();
        echo "ok";
    }
    
    public function add($data){
    	$data = array(
		    'id'      => 'sku_123ABC',
		    'qty'     => 1,
		    'price'   => 39.95,
		    'name'    => 'T-Shirt',
		    'options' => serialize(array('Size' => 'L', 'Color' => 'Red')),
    		'time'=>time(),
		);
		
		$data = implode(',', $data);
		echo $data;
		echo "<br>";
		$sql = "insert into car(qty,price,name,options,time) values($data)";
		echo $sql;
		$this->db->query();
    }
}