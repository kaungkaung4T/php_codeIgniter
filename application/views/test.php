<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="<?php echo base_url()?>application/static/css/style.css" type=" text/css" />

</head>

<body>




	<form action="" method="POST" style="width:400px;margin:auto;padding:110px 0 0 0;">

		<div style="width:280px;margin-right:20px;">
			<i class="bi bi-bank" style="font-size:50px;"></i><br>
			<input type="radio" id="bank" value="bank" name="money" checked="checked">
			<label for="bank">Deposit without bankbook</label>
		</div>


		<div style="width:100px;">
			<i class="bi bi-piggy-bank" style="font-size:50px;"></i><br>
			<input type="radio" id="kpay" value="kpay" name="money">
			<label for="kpay">KBZ Pay</label>
		</div>
		<br><br>
		<input type="submit">

	</form>

<?php
	if (isset($_POST["money"])) {
		if ($_POST["money"] == "kpay") {
			
			header("Location: work");
			exit();
		}
	}

?>

</body>

</html>
