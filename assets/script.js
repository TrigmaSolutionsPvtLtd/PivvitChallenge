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