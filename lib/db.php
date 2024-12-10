<?php

$host = "localhost";
$db =   "warehouse_manager";
$user = "root";
$pass = "";

$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error)die("Errore durante il collegamento al database.");


?>