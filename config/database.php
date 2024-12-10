<?php

//meta data- controls the data from the backend to client or front end
//settings configuration-handle requests
header("Access-Control-Allow-origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST,GET,PATCH,DELETE");
header("Access-Control-Max-Age: 3600");
header("Content-Type: text/plain");

//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
date_default_timezone_set("Asia/Manila"); // default server time

//CONFIGURATION TO COLLECT THE DATABASE-constant
define("SERVER", "localhost");
define("DBASE", "pitchordia_db"); //enter own database /retrieve data
define ("USER", "root");
define("PWORD", "");


class Connection{ // database hander
        //connect to database  driver    concat to  server
    protected $connectionString= "mysql:host=". SERVER . ";dbname=" .DBASE. ";charset=utf8";
     protected $options = [
        \PDO:: ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // default fetch naka array na indexing
        \PDO ::ATTR_EMULATE_PREPARES =>false];

     //returning new pdo instance   method pdo connect to db
    public function connect(){
        return new \PDO($this->connectionString,USER,PWORD, $this->options);
    }
}


?>