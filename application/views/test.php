<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="<?php echo base_url() ?>application/static/css/style.css" type=" text/css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</head>




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

	<div>
		<br><br>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="form-control"><br><br>
		<label for="amount">Amount</label>
		<input type="text" name="amount" id="amount" class="form-control"><br><br>
		<label for="id">ID</label>
		<input type="text" name="id" id="id" class="form-control">

	</div>

	<br><br>
	<input type="submit">

</form>



</body>

</html>
