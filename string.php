<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>

<body>
<?php 
if (isset($_POST['a'])) {
	//TODO 1登記
	$fn = "grade.txt";
	if (($_POST['a']) == 1) {
		//echo "登記";
		$name = $_POST['name'];
		$id = $_POST['id'];
		$email = $_POST['email'];
		$chi = $_POST['chi'];
		$mat = $_POST['mat'];
		$phy = $_POST['phy'];
		$che = $_POST['che'];
		$fin=$name.",".$id.",".$email.",".$chi.",".$mat.",".$phy.",".$che;
		//fwrite($fn, $fin);
		if (($fo = fopen($fn, "a+")) !== false) {
			fwrite($fo, $fin . "\n");
			fclose($fo);
		}
// 		$fin += $_POST['name'].",";
// 		$fin += "".$_POST['id'].",";
// 		$fin += "".$_POST['email'].",";
// 		$fin += "".$_POST['chi'].",";
// 		$fin += "".$_POST['mat'].",";
// 		$fin += "".$_POST['phy'].",";
// 		$fin += "".$_POST['che'].",";
		//fclose($fn);
	}
	//TODO 2統計
	if (($_POST['a']) == 2) {
		//echo "統計";
	}
}


?>
	<form action="calGrade.php" method="POST">
		學生姓名:<input type="text" id="name" name="name"/><br />
		學生學號:<input type="text" id="id" name="id"/><br />
		email:<input type="text" id="email" name="email"/><br />
		國文成績：<input type="text" id="chi" name="chi"/><br />
		數學成績:<input type="text" id="mat" name="mat"/><br />
		物理成績:<input type="text" id="phy" name="phy"/><br />
		化學成績:<input type="text" id="che" name="che"/><br />
		<button id="submit" type="submit" name="a" value="1">登記</button>
		<button type="submit" name="a" value="2">目前統計成績</button>
	</form>
</body>
</html>