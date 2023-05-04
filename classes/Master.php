<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		$check = $this->conn->query("SELECT * FROM `categories` where `category` = '{$category}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Category already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `categories` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Category successfully saved.");
			else
				$this->settings->set_flashdata('success',"Category successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
function delete_category(){
    extract($_POST);
    $del = $this->conn->query("DELETE FROM `categories` where id = '{$id}'");
    if($del){
        $resp['status'] = 'success';
        $this->settings->set_flashdata('success',"Category successfully deleted.");
    }else{
        $resp['status'] = 'failed';
        $resp['error'] = $this->conn->error;
    }
    return json_encode($resp);

}

function delete_img(){
    extract($_POST);
    if(is_file($path)){
        if(unlink($path)){
            $resp['status'] = 'success';
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = 'failed to delete '.$path;
        }
    }else{
        $resp['status'] = 'failed';
        $resp['error'] = 'Unkown '.$path.' path';
    }
    return json_encode($resp);
}

function register(){
    extract($_POST);
    $data = "";
    $_POST['password'] = md5($_POST['password']);
    foreach($_POST as $k =>$v){
        if(!in_array($k,array('id'))){
            if(!empty($data)) $data .=",";
            $data .= " `{$k}`='{$v}' ";
        }
    }
    $check = $this->conn->query("SELECT * FROM `clients` where `email` = '{$email}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
    if($this->capture_err())
        return $this->capture_err();
    if($check > 0){
        $resp['status'] = 'failed';
        $resp['msg'] = "Email already taken.";
        return json_encode($resp);
        exit;
    }
    if(empty($id)){
        $sql = "INSERT INTO `clients` set {$data} ";
        $save = $this->conn->query($sql);
        $id = $this->conn->insert_id;
    }else{
        $sql = "UPDATE `clients` set {$data} where id = '{$id}' ";
        $save = $this->conn->query($sql);
    }
	if($save){
		$resp['status'] = 'success';
		if(empty($id))
			$this->settings->set_flashdata('success',"Account successfully created.");
		else
			$this->settings->set_flashdata('success',"Account successfully updated.");
		foreach($_POST as $k =>$v){
				$this->settings->set_userdata($k,$v);
		}
		$this->settings->set_userdata('id',$id);

	}else{
		$resp['status'] = 'failed';
		$resp['err'] = $this->conn->error."[{$sql}]";
	}
	return json_encode($resp);
}	
function update_account(){
	extract($_POST);
	$data = "";
	if(!empty($password)){
		$_POST['password'] = md5($password);
		if(md5($cpassword) != $this->settings->userdata('password')){
			$resp['status'] = 'failed';
			$resp['msg'] = "Current Password is Incorrect";
			return json_encode($resp);
			exit;
		}

	}
	$check = $this->conn->query("SELECT * FROM `clients`  where `email`='{$email}' and `id` != $id ")->num_rows;
	if($check > 0){
		$resp['status'] = 'failed';
		$resp['msg'] = "Email already taken.";
		return json_encode($resp);
		exit;
	}
	foreach($_POST as $k =>$v){
		if($k == 'cpassword' || ($k == 'password' && empty($v)))
			continue;
			if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
	}
	$save = $this->conn->query("UPDATE `clients` set $data where id = $id ");
	if($save){
		foreach($_POST as $k =>$v){
			if($k != 'cpassword')
			$this->settings->set_userdata($k,$v);
		}
		
		$this->settings->set_userdata('id',$this->conn->insert_id);
		$resp['status'] = 'success';
	}else{
		$resp['status'] = 'failed';
		$resp['error'] = $this->conn->error;
	}
	return json_encode($resp);

}
}
$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
case 'save_category':
	echo $Master->save_category();
break;
case 'delete_category':
	echo $Master->delete_category();
break;

case 'register':
	echo $Master->register();
break;

case 'delete_img':
	echo $Master->delete_img();
break;

case 'update_account':
	echo $Master->update_account();
break;

default:
	// echo $sysset->index();
	break;
}