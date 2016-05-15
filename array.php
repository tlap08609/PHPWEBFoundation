<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<body>
<h1>key-value</h1>
	<?php 
	$i = array(
			"1" => "tt",
			"2" => "dog","cat",
			1 => "tt",
			2.5 => "rr",
			3 => "tim",
			5 => "aice","eva",
			6 => array(1,2,3,4,5),
			7 => array(1,2,3,4,5)
	);
	//var_dump($i);
	print_r($i);
	//echo $i[6][0];
	
// 	$l = array(1,1,1,1,2,3,4,5);
// 	foreach ($l as $lndex) {
// 		echo $lndex." ";
// 	}
	?>
	<h1>no value</h1>
	<?php 
	$foo = array("bob", "fred", "jussi", "jouni", "egon", "marliese");
	$bar = each($foo);
	print_r($bar);
	?>
	
	
</body>
</html>
