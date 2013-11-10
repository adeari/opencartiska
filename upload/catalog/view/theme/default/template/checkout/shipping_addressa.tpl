<p><?php echo $ambilsendiriinfo.$SMSnum; ?></p>
<br />
<div class="buttons">
  <div class="right">
    <input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-addressc" class="button" />
  </div>
</div>
<script>

$('#button-shipping-addressc').live('click', function() {
	$.ajax({
	url: 'index.php?route=checkout/shipping_address/validatec',
		type: 'post',
		dataType: 'json',
		beforeSend: function() {
			$('#button-shipping-addressc').attr('disabled', true);
			$('#button-shipping-addressc').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-shipping-addressc').attr('disabled', false);
			$('.wait').remove();
		},	
		success: function(json) {
			$.ajax({
					url: 'index.php?route=checkout/payment_method',
					dataType: 'html',
					success: function(html) {
						$('#payment-method .checkout-content').html(html);
						
						$('#shipping-method .checkout-content').slideUp('slow');
						
						$('#payment-method .checkout-content').slideDown('slow');

						$('#shipping-method .checkout-heading a').remove();
						$('#payment-method .checkout-heading a').remove();
						
						$('#shipping-method .checkout-heading').append('<a><?php echo $text_modify; ?></a>');	
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});
</script>