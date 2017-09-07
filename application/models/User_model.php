<?php
class User_model extends CI_Model {

    public $username;
    public $password;
    public $time;

    public function get_last_ten_entries(){
        $query = $this->db->get('User', 10);
        return $query->result();
    }

    public function insert_user(){
        $this->username    = $this->input->post('username');//$_POST['title']; // please read the below note
        $this->password  = $this->input->post('password'); //$_POST['content'];
        $this->time  = time();
        $this->db->insert('user', $this);
    }

    public function update_user(){
        $this->username    = $this->input->post('username');//$_POST['title']; // please read the below note
        $this->password  = $this->input->post('password'); //$_POST['content'];
        $this->time  = time();
        $this->db->update('user', $this, array('id' => $this->input->post('username')));
    }
    
    public function check_user($user){
    	$sql = "select id,password from ci_user where username=".$this->db->escape($user['username'])."";
    	$query = $this->db->query($sql); 
    	$row = $query->first_row();
    	if(empty($row)){
    		return 0;	
    	}
    	if($row->password!=md5($user['password'])){
    		return 0;
    	}
    	return $row;
    }
    
    
    public function add_car($data){
    	$data['options'] = serialize($data['options']);
		$data = _addslashes($data, array())	;
		print_r($this->db);
		$this->db->insert_string('car', $data);
   		$this->db->cache_delete('/admin','part');     //Çå³ı»º´æÎÄ¼ş£¬
    }

}