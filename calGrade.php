<?php 
	function redFont($arg) {
		return $arg<60 ?"<font color='red'>".$arg."</font>":$arg;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>統計成績程式</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<style>
table, th, td {
    border: 1px solid black;
}

</style>
</head>
<body>

<?php 
if (isset($_POST['a'])) {
	$fn = "grade.txt";
	if (($_POST['a']) == 1) {
		$name = $_POST['name'];
		$id = $_POST['id'];
		$email = $_POST['email'];
		$chi = $_POST['chi'];
		$eng = $_POST['eng'];
		$mat = $_POST['mat'];
		$phy = $_POST['phy'];
		$che = $_POST['che'];
		$fin=$name.",".$id.",".$email.",".$chi.",".$eng.",".$mat.",".$phy.",".$che;
		if (($fo = fopen($fn, "a+")) !== false) {
			fwrite($fo, $fin."\n");
			fclose($fo);
		}
		echo "<h1>登記完成</h1>";
	}
	if (($_POST['a']) == 2) {
		if (file_exists($fn)){
			$fna = file($fn);
			$avg;$sum;
			$total=0;$totalAvg=0;
			echo "<table><thead><tr><th>流水號</th><th>名字</th><th>學號</th><th>email</th>
				<th>國文</th><th>英文</th><th>數學</th><th>物理</th><th>化學</th>
				<th>總分</th><th>平均分數</th></tr></thead><tbody>";
			if (sizeof($fna)==0) {
				echo "<tr><td colspan='11' style='color:red;text-align:center;'>並無資料</td></tr>";
			} else {
				for ($i=0;$i<sizeof($fna);$i++) {
					list($n,$id,$em,$c1,$e,$m,$p,$c2) = split(",",$fna[$i]);
					$sum = $c1+$m+$e+$p+$c2;
					$avg = $sum/5;
					$total+=$avg;
					echo "<tr><td>".$i."</td><td>".$n."</td><td>".$id."</td><td>".$em."</td>".
							"<td>".redFont($c1)."</td><td>".redFont($e)."</td><td>".redFont($m)."</td><td>".redFont($p)."</td><td>".redFont($c2)."</td>".
							"<td>".$sum."</td><td>".$avg."</td></tr>";
				}
				$totalAvg = number_format($total/sizeof($fna),2);
				echo "<tr><td>全班總平均:</td><td colspan='10' style='text-align:right;'>".redFont($totalAvg)."分</td></tr>";
			}
			echo "</tbody></table>";
		} else {
			echo "<h1>檔案不存在，請先建立檔案</h1>";
		}
	}
	if (($_POST['a']) == 3) {
		if (file_exists($fn)) {
			$student=array();
			$allTotal=array();
			$grade=array(0,0,0,0,0,0,0);
			$count = 0;
			$fna = file($fn);
			if (sizeof($fna)>0) {
				echo "<table><thead><tr><th>排名</th><th>名字</th><th>學號</th><th>email</th>
				<th>國文</th><th>英文</th><th>數學</th><th>物理</th><th>化學</th>
				<th>總分</th><th>平均分數</th></tr></thead><tbody>";
				for ($i=0;$i<sizeof($fna);$i++) {
					list($n,$id,$em,$c1,$e,$m,$p,$c2) = split(",",$fna[$i]);
					$student[$id] = array($n,$id,$em,$c1,$e,$m,$p,$c2);
					$allTotal[$id] = $c1+$e+$m+$p+$c2;
				}
				arsort($allTotal);
				foreach ($allTotal as $k => $v){
					$grade[0] += $student[$k][3];
					$grade[1] += $student[$k][4];
					$grade[2] += $student[$k][5];
					$grade[3] += $student[$k][6];
					$grade[4] += $student[$k][7];
					$grade[5] += $v;
					$grade[6] += number_format($v/5,2);
					echo "<tr><td>".++$count."</td><td>".$student[$k][0]."</td><td>".$student[$k][1]."</td><td>".$student[$k][2]."</td>".
							"<td>".redFont($student[$k][3])."</td><td>".redFont($student[$k][4])."</td><td>".redFont($student[$k][5])."</td><td>".redFont($student[$k][6])."</td><td>".redFont($student[$k][7])."</td>".
							"<td>".$v."</td><td>".number_format($v/5,2)."</td></tr>";
				}
				echo "<tr><td colspan='4'>平均</td><td>".number_format($grade[0]/$count,2)."</td><td>".number_format($grade[1]/$count,2)."</td><td>".number_format($grade[2]/$count,2)."</td>".
						"<td>".number_format($grade[3]/$count,2)."</td><td>".number_format($grade[4]/$count,2)."</td><td>".number_format($grade[5]/$count,2)."</td><td>".number_format($grade[6]/$count,2).
						"</tr>";
				echo "</tbody></table>";
			} else {
				echo "<h1>檔案無筆數</h1>";
			}
		} else {
			echo "<h1>檔案不存在，請先建立檔案</h1>";
		}
	}
	if (($_POST['a']) == 4) {
		$fo = fopen($fn, "w");
		echo "<h1>reset完成</h1>";
	}
}
?>
	<form action="calGrade.php" method="POST">
		學生姓名:<input type="text" id="name" name="name"/><br />
		學生學號:<input type="text"		//TODO排序 id="id" name="id"/><br />
		email:<input type="text" id="email" name="email"/><br />
		國文成績：<input type="text" id="chi" name="chi"/><br />
		英文成績：<input type="text" id="eng" name="eng"/><br />
		數學成績:<input type="text" id="mat" name="mat"/><br />
		物理成績:<input type="text" id="phy" name="phy"/><br />
		化學成績:<input type="text" id="che" name="che"/><br />
		<button id="submit" type="submit" name="a" value="1">登記</button>
		<button type="submit" name="a" value="2">統計成績（按keyIn時間排序）</button>
		<button type="submit" name="a" value="3">統計成績（按總分排名大到小排序並且有全班平均）</button>
		<button type="submit" name="a" value="4">RESET</button>
	</form>
</body>
</html>
<script>
//chinese unicode
//http://www.khngai.com/chinese/charmap/tbluni.php?page=0
$(function(){
	$('#submit').click(function(){
		var flag=true;
		var nameP = /[a-z\u4e00-\u9eff]{1,}/ ;
		var idP =/[\w\d]+/;
		var emailP = /[\w\d]+@[\w]{1,}.[\w]{2,3}/;
		var gradeP=/^[1-9][0-9]?$|^100$/;
		$('span').remove();
		if (!nameP.test($('#name').val())) {
			flag=false;
			$('input[id^=na]').after("<span style=\"color:red\"> 名字格式錯誤</span>");
		} 
		if (!idP.test($('#id').val())) {
			flag=false;
			$('input[id^=id]').after("<span style=\"color:red\"> 學號格式錯誤</span>");
		}
		if (!emailP.test($('#email').val())) {
			flag=false;
			$('input[id^=em]').after("<span style=\"color:red\"> email格式錯誤</span>");
		}
		if (!gradeP.test($('#chi').val())) {
			flag=false;
			$('input[id^=chi]').after("<span style=\"color:red\"> 國文分數格式錯誤</span>");
		}
		if (!gradeP.test($('#eng').val())) {
			flag=false;
			$('input[id^=eng]').after("<span style=\"color:red\"> 英文分數格式錯誤</span>");
		}
		if (!gradeP.test($('#mat').val())) {
			flag=false;
			$('input[id^=mat]').after("<span style=\"color:red\"> 數學分數格式錯誤</span>");
		}
		if (!gradeP.test($('#phy').val())) {
			flag=false;
			$('input[id^=phy]').after("<span style=\"color:red\"> 物理分數格式錯誤</span>");
		}
		if (!gradeP.test($('#che').val())) {
			flag=false;
			$('input[id^=che]').after("<span style=\"color:red\"> 化學分數格式錯誤</span>");
		}
		if (flag == false) {
			return false;
		} 
		return true;		
	});
})

</script>