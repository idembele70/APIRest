<?php

$url = 'http://localhost/Clay/apiREST/';
$data = array ('name' => 'PEC', 'description' => 'Pencil 2H', 'price' =>'2.25', 'category' => '9');

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
    );
    $context = stream_context_create ($options);
    $result = file_get_contents($url, false, $context);
if ($result === FALSE) {}
var_dump($result);

?>