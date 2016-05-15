<?php
//header("Content-type: text/javascript");
// $arr = array(
// 		array(
// 				"first_name" => "Darian",
// 				"last_name" => "Brown",
// 				"age" => "28",
// 				"email" => "darianbr@example.com"
// 		),
// 		array(
// 				"first_name" => "John",
// 				"last_name" => "Doe",
// 				"age" => "47",
// 				"email" => "john_doe@example.com"
// 		)
// );
$d['a']['apple']='蘋果';
$d['a']['arange']='排列';
$d['b']['ball']='球';
$d['c']['cat']='貓';
$d['z']['zombie']='殭屍';
$d['z']['zero']='零';

echo json_encode($d);
?>


