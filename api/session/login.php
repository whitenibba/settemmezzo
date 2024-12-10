<?php

include(dirname(dirname(__DIR__)).'\\lib\\db.php');

if($_SERVER['REQUEST_METHOD']=="POST"){
    $data= json_decode($entityBody = file_get_contents('php://input'),true);
    //var_dump( file_get_contents('php://input'));
    if(!isset($data))die('{"err":"-3"}');

    $md5=md5($data['pass']);
    $query='SELECT id,pass FROM users WHERE user = "'.$data['user'].'" AND pass = "'.$md5.'" LIMIT 1;';
    
    $res=mysqli_query($conn,$query);
    if(!$res){
        $conn->close();
        die('{"err":"-2"}');
    }
    $logged=false;
    if($row=$res->fetch_assoc()){
        $_SESSION['id']=$row['id'];
        $_SESSION['page_size']=15;
        $response = '{ "id" : '.$_SESSION['id'].'}';
        echo $response;
        $logged = true;
    } 
    
    if(!$logged){
        echo "{\"id\":-1}";
    }
}

$conn->close();

?>