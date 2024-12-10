<?php
//Errore -1 login non effettuato
if(!isset($_SESSION['id']))die(-1);

include(dirname(dirname(__DIR__)).'/lib/db.php');



//Errore -2 Inviati dati non corretti
if(!isset($_POST['id'])){
    $conn->close();
    die(-2);
}


$query = "UPDATE warehouse_".$_SESSION['id'].' SET';

//Variabile booleana che accerta che ci siano campi da cambiare
$toModify = false;

//Ogni if aggiunge un pezzo di query con i cambiamenti
//Ogni query deve aggiungere lo SPAZIO PRIMA e non dopo

if(isset($_POST['name'])){
    $query.= ' name="'.$_POST['name'].'"';
    $toModify = true;
}

if(isset($_POST['code'])){
    if(is_numeric($_POST['code'])){
        $query.= ' code='.$_POST['code'];
        $toModify = true;
    }else{
        //Errore -4 Un campo numerico non rispetta i criteri
        echo "-4";
    }
}


if(isset($_POST['qty'])){
    if(is_numeric($_POST['qty'])){
        $query.= ' qty='.$_POST['qty'];
        $toModify = true;
    }else{
        //Errore -4 Un campo numerico non rispetta i criteri
        echo "-4";
    }
}

if(isset($_POST['location'])){
    $query.= ' location="'.$_POST['location'].'"';
    $toModify = true;
}

if(isset($_POST['img'])){
    $query.= ' img="'.$_POST['img'].'"';
    $toModify = true;
}

$query .= " WHERE id=".$_POST['id'];

if($toModify){
    $res=$conn->query($query);
    //Errore -3 errore di query
    if(!$res)echo -3;
}


$conn->close();