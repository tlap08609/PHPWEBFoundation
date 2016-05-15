<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
	<ul></ul>
	<form action="dictionary.php" method="post">
	<?php 
	if (isset($_POST['input'])) {
		include 'dictionaryArray.php';
		foreach ($d as $index => $key) {
			foreach ($key as $eng => $chn) {
				if ($_POST['input'] == $eng) {
					echo "<h3>你查詢的是:".$chn."</h3>";
				}
				if ($_POST['input'] == $chn) {
					echo "<h3>你查詢的是:".$eng."</h3>";
				}
			}
		}

	} else {
		echo "<h3>請輸入查詢︰</h3>";
	}
	?>
	<input type="text" name="input"/>
	<input type="submit">
	<p>或依照字母查詢:
	<?php 
	$A = range('a', 'z');
	foreach ($A as $a) {
		
		echo "<a href=\"dictionary.php?pre=$a\">".$a."</a>"."  ";
	}
	?>
	</p>
	<?php 
	if (isset($_GET["pre"])) {
		foreach ($d as $index => $key) {
			foreach ($key as $eng => $chn) {
				if ($_GET["pre"] == $index) {
					echo "<p>".$eng.$chn."</p>";
				}
			}
		}
	}
	
	?>
	<div class="answer"></div>
	</form>
</body>
</html>
<script>
$(function(){




	
	$.getJSON('dictionaryArray.php', function(data) {
        $.each(data, function(key, val) {
        	$.each(val, function(k, v) {
               $('ul').append('<li>' + key + ' ' + k + ' ' + v + '</li>');
            });
        });
	});
	$('ul').click(function(e){
		//alert(e.type);
		//e.preventDefault();
	})
})
</script>


