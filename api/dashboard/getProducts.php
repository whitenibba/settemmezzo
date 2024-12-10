<?php

$offset = 0; //Numero di prodotti da saltare durante la selezione in base alla grandezza della pagina

//Errore -1 se non è stato effettuato il login
if(!isset($_SESSION['id'])) {
    die ('{"id": "-1"}');
}


elseif (isset($_GET['logged'])) {//Usata lato client per controllare se l'utente è loggato
    die('{"id": "'.$_SESSION['id'].'"}');
}

$setted = false;
if(isset($_GET['page_size']) && is_numeric($_GET['page_size']) && $_GET['page_size']>=1){
    $_SESSION['page_size']=$_GET['page_size'];
    $setted=true;
}

include(dirname(dirname(__DIR__)).'/lib/db.php');

$data= json_decode($entityBody = file_get_contents('php://input'),true);

if(isset($data['page'])){
    $offset = $_SESSION['page_size'] * ($data['page'] - 1);
    if($offset < 0) $offset = 0;
}

//Parte iniziale della query
$query = 'SELECT * FROM warehouse_'.$_SESSION['id'].' WHERE TRUE';
$countQuery = "SELECT COUNT(id) AS n FROM warehouse_".$_SESSION['id'].' WHERE TRUE';

//Parte centrale della query (SOLO IN CASO DI RICERCA)
if(isset($data['search'])){
    $query.=' AND ((name LIKE "%'.$data['search'].'%") OR (code LIKE "%'.$data['search'].'%") OR (location LIKE "%'.$data['search'].'%"))';
    $countQuery.=' AND ((name LIKE "%'.$data['search'].'%") OR (code LIKE "%'.$data['search'].'%") OR (location LIKE "%'.$data['search'].'%"))';
}

if(isset($_GET['category'])){
    $query .= ' AND category='.$_GET['category'];
    $countQuery .= ' AND category='.$_GET['category']; 
}
 
//Parte finale della query
$query.=' LIMIT '.$_SESSION['page_size']." OFFSET ".$offset.";";
$countQuery.=";";
$res = $conn->query($query);

//Errore -2 se c'è un errore di query
if(!$res){
    $conn->close();
    die ('{"id": "-2"}');
}

$counter = 0;
$table;
while($row = $res->fetch_object()){
    $table[$counter]=$row;
    $counter++;
}


//echo $countQuery;

$res = $conn->query($countQuery);
$res = $res->fetch_assoc();
$conn->close();

if($counter>0){
    $result = '{"products":'.json_encode($table).' , "n_products" : '.$res['n'];
}else{
    $result = '{"products":[] , "n_products" : 0';
}
$result.=', "page_size_setted" : "'.($setted?"true" : "false").'"}';
echo $result;



