<?php
//headers
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

//initilied the api
include_once('../core/Initialize.php');
//instantiate address
$address = new Address($db);
//blog address query
$result = $address->read();
//get the row count
$num = $result->rowCount();
if ($num > 0) {
    $address_array();
    $address_array['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            "gn" => $gn,
            "area" => $area,
            "nb" => $nb,
            "town" => $town
        );
        array_push($address_array['data'], $address_item);
    }
    //convert to JSON and output
    echo json_encode($address_array);
} else {
    echo json_encode(array('message' => 'No Address Found..'));
}
