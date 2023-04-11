<?php
if(defined('DB_SERVER')){
    require_once("../initialize.php");
}
class DBCoonnection{
    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    public $conn;
}