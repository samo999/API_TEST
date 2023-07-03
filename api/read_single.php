<?php
//headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

//initilied the api
include_once('../core/Initialize.php');
//instantiate address
$address = new Address($db);

$address->gn=isset($_GET['gn'])? $_GET['gn']:die();
$address->read_single();
$address_array=array(
    'gn'=>$address->gn,
    'area'=>$address->area,
    'nb'=>$address->nb,
    'town'=>$address->town,
);
print_r(json_encode($address_array));