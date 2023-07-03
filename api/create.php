<?php
//headers
use function PHPSTORM_META\type;
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,');
//initilied the api
include_once('../core/Initialize.php');
//instantiate address
$address = new Address($db);
//get the posted data
$data=json_decode(file_get_contents("php://input"));

$address->gn=$address->gn;
$address->area=$address->area;
$address->nb=$address->nb;
$address->town=$address->town;

//create address
if($address->create())
{
echo json_encode(
    array('message'=>'ADDRESS CREATED.')
);
}
else{
    echo json_encode(
        array('message'=>'ADDRESS NOT CREATED.')
    );}

