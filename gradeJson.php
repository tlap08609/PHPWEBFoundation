<?php 
$fn = "grade.txt";
if (file_exists($fn)) {
	$fna = file($fn);
	if (sizeof($fna>0)) {
		$idGroup = array();
		for ($i=0;$i<sizeof($fna);$i++) {
			list($n,$id,$em,$c1,$e,$m,$p,$c2) = split(",",$fna[$i]);
			 $idGroup[$i] = $id;
		}
		echo json_encode($idGroup);
	} else {
		echo "無筆數";
	}
} else {
	echo "null";
}
?>




