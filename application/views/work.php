<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment</title>
	<!-- AJAX -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lrsjng.jquery-qrcode/0.17.0/jquery-qrcode.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" async></script>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="width:600px;margin:auto;padding:220px 0 0 0;">
	<h1><?php echo $title; ?></h1>

	<p><?php echo $message; ?></p>

	<form id="form_submit">
		<div class="row container-fluid">
			<div class="col form-group">
				<label for="merch_order_id">Merch Order ID</label>
				<input type="text" class="form-control" id="merch_order_id" name="merch_order_id" placeholder="Merch Order ID">
			</div>
			<div class="col form-group">
				<label for="total_amt">Total Amount</label>
				<input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="Total Amount">
			</div>
			<div class="col">
				<br />
				<input class="btn btn-secondary" type="submit" value="Submit" />
			</div>
		</div>
	</form>

	<div class="container" id="qr_code">

	</div>

	<div id="t_status">
		<h3 class='text-success text-center' id='t_success'></h3>
	</div>

	<script>
		$("#form_submit").submit(function(e) {
			e.preventDefault();
			var merch_order_id = $("#merch_order_id").val();
			var total_amt = $("#total_amt").val();
			$.ajax({
				type: "POST",
				url: "/createOrder",
				data: {
					merch_order_id: merch_order_id,
					total_amt: total_amt
				},
				success: function(data) {
					//parse json
					var response_json = JSON.parse(data);
					// console.log(response_json);

					$('#qr_code').qrcode({
						text: response_json.Response.qrCode,
						render: "canvas", // 'canvas' or 'table'. Default value is 'canvas'
						background: "#ffffff",
						foreground: "#000000",
					});

					var checkQuery = function(data) {
						// console.log(data);
						$.ajax({
							type: "POST",
							url: "/queryOrder",
							data: {
								merch_order_id: response_json.Response.merch_order_id,
							},
							success: function(queryOrder) {
								var queryOrder_json = JSON.parse(queryOrder);
								// console.log(queryOrder_json);

								if (queryOrder_json.Response.trade_status == "WAIT_PAY") {
									$("#t_status").html("<h3 class='bg-danger text-white text-center' id='t_success'>Waiting for payment</h3>");
								} else {
									$("#t_status").html("<h3 class='bg-success text-white text-center' id='t_success'>Payment Successful</h3>");
								}
							}
						});
					};

					// if (queryOrder_json.Response.trade_status == "WAIT_PAY") {
					var intervalQuery = setInterval(checkQuery, 10000);
					// }
				}
			});
		});
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
