<?php
ob_strat();
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;

function redirect($url = ''){
    if(!empty($url))
     echo '<script>location.href= "'.base_url .$url.'"</script>';

}
 function validate_image($file){
    if(!empty($file)){

      if(is_file(base_app.$file)){
           return base_url.$file;
      }else{
           return base_url.'dist/img/no-image-available.png';
      }

    }else{
            return base_url .'dist/img/no-image-available.png';
      }
    }
    
ob_end_flush();
 ?>