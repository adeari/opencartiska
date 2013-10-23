<?php 
$getdata = http_build_query(
array(
    'API-Key' => 'f7da17c2d33e2079d2fc7a2efd38c499',
    'from' => 'jakarta',
 'to'=>'surabaya',
 'weight'=>'1500',
 'courier'=>'jne',
 'format'=>'json'
 )
);
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $getdata,
    )
);



$context  = stream_context_create($opts);

$result = file_get_contents('http://api.ongkir.info/cost/find' , false, $context);
echo $result,"ggg" ;
?>