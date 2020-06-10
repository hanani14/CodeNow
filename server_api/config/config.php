<?php

define ('DB_NAME','db_projectad'); //Database
define ('DB_USER', 'root'); //Root default
define ('DB_PASSWORD', ''); //password
define ('DB_HOST', 'localhost'); //local 

$mysqli = new mysqli(DB_HOST, DB_USER,DB_PASSWORD);
//if not exits database
$db_selected = mysqli_select_db($mysqli,'db_projectad');

if(!$db_selected){
    $sql= "CREATE DATABASE  db_projectad";
    mysqli_query($mysqli,$sql);
}


//if not exists table
$sqlQuery = "CREATE TABLE IF NOT EXISTS master_user(
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL ,
    password VARCHAR(50) NOT NULL ,
    status CHAR NOT NULL , 
    created_at DATE NOT NULL,
    html INT NOT NULL,
    css INT NOT NULL,
    php INT NOT NULL )";
  
  
mysqli_query($mysqli,$sqlQuery);


?> 