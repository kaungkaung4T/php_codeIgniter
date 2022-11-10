<!DOCTYPE html>
<html lang="en">

<style>
	.vam {
		display: flex;
	}

	.d1 {
		width: 200px;
		height: 200px;
		/* background-color: red; */
	}

	.d2 {
		width: 200px;
		height: 200px;
		/* background-color: blue; */
	}
</style>


<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<title>Document</title>
</head>

<body>

	<h1><?php echo $header ?></h1>
	<h4><?php echo $text ?></h4>


	<h5><?php echo $age ?></h5>

	<div class="vam">
		<div class="d1">
			wefwef
		</div>
		<div class="d2">
			ffffffffff
		</div>
	</div>
	<button onclick="fun()">CLICK</button>

</body>

</html>


<script>
	function fun() {
		$(".d1").css("background", "purple");
		$(".d2").css("background", "purple");
	}
</script>


<?php

function fun($x)
{
	return $x;
}

$f = fun(103242340);
echo $f;

?>
