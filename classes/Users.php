<?php
require_once('../config.php');
Class Users extends DBConnection {
    private $settings;
    public function __construct(){
        global $_settings;
        $this ->settings = $_settings;
        parent::__construct();
    }
    public function_destruct(){
        parent::_destruct();
    }
    public function save_users(){
        extract($_POST);
        $data = '';
        foreach($_POST as $k =>$v){
            if(!in_array($k,array('id','password'))){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
        }
    }
    if(!empty($password) && !empty($id)){
        $password = md5($password);
        if(!empty($data)) $data .=" , ";
        $data .= " `password` = '{$password}' ";
    }
    if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
        $fname = 'uploads/'.strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
        $move = move_uploaded_file($_FILES['img']['tmp_name'],'../'. $fname);
        if($move){
            $data .=" , avatar = '{$fname}' ";
            if(isset($_SESSION['userdata']['avatar']) && is_file('../'.$_SESSION['userdata']['avatar']))
                unlink('../'.$_SESSION['userdata']['avatar']);
        }
    }
    if(empty($id)){
        $qry = $this->conn->query("INSERT INTO users set {$data}");
        if($qry){
            $this-> settings->set_flashdata('succes','User Details successfully saved.');
            foreach($_POST as $k => $v){
                if($k != 'id'){
                    if(!empty($data)) $data .= " , ";
                    $this->settings->set_userdata($k,$v);
                }
            }
            return 1;
        }else{
            return 2;
        }
    }else{
        $qry = $this->query("UPDATE users set $data where id = {$id}");
        if($qry){
            $this->settings->set_flashdata('success','User Details successfully updated.');
            foreach($_POST as $k => $v){
                if($k != 'id'){
                    if(!empty($data)) $data .=" , ";
                    $this->settings->set_userdata($k,$v);
                }
            }
            if(isset($fname) && isset($move))
            $this->settings->set_userdata('avatar',$fname);

            return 1;
        }else{
            return "UPDATE users set $data where id = {$id}";
        }
        
    }
}
  public function save_fusers(){
    extract($_POST);
    $data = "";
    foreach($_POST as $k => $v){
        if(!in_array($k, array('id','password'))){
            if(!empty($data)) $data .= ", ";
            $data .= " `{$k}` = '{$v}' ";
        }
    }
  }
}