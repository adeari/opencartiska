<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<p><?php echo $text_shipping_method; ?></p>
<table class="radio">
  <?php foreach ($shipping_methods as $shipping_method) { ?>
  <?php if (!$shipping_method['error']) { ?>
  <tr>
    <td colspan="3"><b><?php echo $shipping_method['title']; ?></b></td>
  </tr>  
  <?php foreach ($shipping_method['quote'] as $quote) { ?>
  <tr class="highlight">
    <td><?php if ($quote['code'] == 'jne.jne1') { ?>
      <?php $code = $quote['code']; ?>
      <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
      <?php } else if ($shipSelected&&$selecShipii==$quote['code']) { ?>
      <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
      <?php } else { ?>
      <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" />
      <?php } ?></td>
    <td><label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label></td>
	<?php if ($showRupiah) { ?>
    <td style="text-align: right;"><label for="<?php echo $quote['code']; ?>"><?php echo $quote['text']; ?></label></td>
	<?php } ?>
  </tr>  
  <?php } ?>
  <?php } ?>
  <?php } ?>
</table>
<br />
<?php } ?>
<?php if ($showRupiah) { ?>
<b><?php echo $text_comments; ?></b>
<textarea name="comment" rows="8" style="width: 98%;"><?php echo $comment; ?></textarea>
<br />
<br />
<?php } ?>


<div class="buttons">
  <div class="right">
  <?php if ($showRupiah) { ?>
  	<input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-method" class="button" />
  <?php } else { ?>
    <input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-method1" class="button" />
  <?php } ?>
  </div>
</div>
<script type="text/javascript">
$('#shipping-address .checkout-content input[name=\'shipping_method\']').live('click', function() {	
	showDetailShipping(this.value);
});
function showDetailShipping(valii){
	if (valii=='pickup.pickup'||$('#shipping-address .checkout-content input[name=\'shipping_method\']').eq(1).is(':checked')) {
		$('#pilihJne').css('display','none');
		$('#payment-method .checkout-heading').html('<?php echo $text_checkout_payment_method; ?>');
		$('#confirm .checkout-heading').html('<?php echo $text_checkout_confirm; ?>');
	} else {
		$('#pilihJne').css('display','block');		
		$('#payment-method .checkout-heading').html('<?php echo $text_checkout_payment_method1; ?>');
		$('#confirm .checkout-heading').html('<?php echo $text_checkout_confirm1; ?>');
	}
}
$(document).ready(function() {
	showDetailShipping($('#shipping-address .checkout-content input[name=\'shipping_method\']').val());
});

</script>