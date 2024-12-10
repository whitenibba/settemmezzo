<?php
//Errore -1 login non effettuato
if(!isset($_SESSION['id']))die(-1);

include(dirname(dirname(__DIR__)).'/lib/db.php');


$query = "INSERT INTO warehouse_".$_SESSION['id']." (";

//Variabile booleana che accerta che ci siano dati da aggiungere
$toInsert = false;

//Seconda parte della query (dove vanno inseriti i valrori)
$query1=") VALUES (";


//Ogni if aggiunge un pezzo di query

if(isset($_POST['name'])){
    $query .=   ' name,';
    $query1 .=  '"'.$_POST['name'].'",';
    $toInsert = true;
}

if(isset($_POST['code'])){
    if(is_numeric($_POST['code'])){
        $query .=   ' code,';
        $query1 .=  $_POST['code'].',';
        $toInsert = true;
    }else{
        //Errore -4 Un campo numerico non rispetta i criteri
        $conn->close();
        die("-4");
    }
}


if(isset($_POST['qty'])){
    if(is_numeric($_POST['qty'])){
        $query .=   ' qty,';
        $query1 .=  $_POST['qty'].',';
        $toInsert = true;
    }else{
        //Errore -4 Un campo numerico non rispetta i criteri
        $conn->close();
        die("-4");
    }
}

if(isset($_POST['location'])){
    $query .=   ' location,';
    $query1 .=  '"'.$_POST['location'].'",';
    $toInsert = true;
}

if(isset($_POST['img'])){
    $query .=   ' img,';
    $query1 .=  '"'.$_POST['img'].'",';
    $toInsert = true;
}


if($toInsert){

    $t=     rtrim($query,",");
    $query= $t;
    $t=     rtrim($query1,",");
    $query.=$t.')'; 


    $res=$conn->query($query);
    //Errore -3 errore di query
    if(!$res)echo -3;
    else echo 1;
}


$conn->close();