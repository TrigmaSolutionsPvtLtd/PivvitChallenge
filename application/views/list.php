<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Make a Purchase</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
	<style type="text/css">
		table{
			width:50%;
			margin: 15% auto auto auto;
			background-color: #D0D0D0; 
			padding:20px;
			box-shadow: 0 0 8px #D0D0D0;
			font-size:14px;
		}
		select, input{
			width:300px;
		}
		
		label.error {
			clear: both;
			color: red;
			display: block;
			font-size: 14px;
		}
		#grandtotal{
			font-weight:bold;
		}
	</style>
	<script>
		function calculate(){
			var total = $('#offering').find(':selected').data('price')*$('#qty').val();
			if(isNaN(total)) total=0;
			$('#grandtotal').html("Total: "+total);
		}
		jQuery(document).ready(function(){
			jQuery( "#offering_frm" ).validate({
				  rules: {
					offering: {
					  required: true
					},
					customer_name: {
					  required: true
					},
					quantity: {
					  required: true,
					  digits: true
					},
				  }
			});
			
			var offering = $('#offering');
			var qty = $('#qty');
			offering.change(calculate);
			qty.keyup(calculate);
		});
	</script>
</head>
<body>
	<form method="post" name="offering" id="offering_frm">
		<table>
			<tr>
				<th>Purchase ID</th>
				<th>Offering title</th>
				<th>Quantity</th>
				<th>Unit price</th>
				<th>Total</th>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>