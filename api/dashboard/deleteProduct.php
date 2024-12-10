<?php

//Errore -1 login non effettuato
if(!isset($_SESSION['id']))die(-1);

include(dirname(dirname(__DIR__)).'/lib/db.php');



//Errore -2 Inviati dati non corretti
if(!isset($_POST['id'])){
    $conn->close();
    die(-2);
}


$query = "DELETE FROM warehouse_".$_SESSION['id'].' WHERE id="'.$_POST['id'].'"';

$res=$conn->query($query);
//Errore -3 errore di query
if(!$res)echo -4;



$conn->close();