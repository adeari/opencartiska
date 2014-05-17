<div id="shipping-new">
  <table class="form">
  	<tr>
      <td colspan="2"><h3><?php echo $jenispengiriman; ?></h3></td>
    </tr>
  	<tr>
      <td colspan="2"><label><input type="radio" name="jenispengiriman" value="sendiri" id="jenispengirimansendiri" checked="checked" /><label for="sendiril"><?php echo $kesendiri; ?></label></label></td>
    </tr>
    <tr>
      <td colspan="2"><label><input type="radio" name="jenispengiriman" value="lain" id="jenispengirimanlain" /><label for="kelain1"><?php echo $kelain; ?></label></label></td>
    </tr>
    <tr>
      <td colspan="2"><br/><h3><?php echo $tujuan; ?></h3></td>
    </tr>
    <tr>
      <td><span class="required">*</span> <?php echo $entry_name; ?></td>
      <td><input type="text" name="name" class="large-field" value="<?php echo $guest_name; ?>" /></td>
    </tr>
    <tr>
      <td><span class="required">*</span> No HP. / Telp.:</td>
      <td><input type="text" name="hp" class="large-field" value="<?php echo $nohp; ?>" /></td>
    </tr>
    <tr>
      <td><?php echo $entry_address; ?></td>
      <td><input type="text" name="address_1" value="<?php echo $address_1; ?>" class="large-field" /></td>
    </tr>
    <tr>
      <td><?php echo $entry_kecamatan; ?></td>
      <td><input type="text" name="kecamatan" value="<?php echo $kecamatan; ?>" class="large-field" /></td>
    </tr>
    <tr>
      <td><span class="required">*</span> <?php echo $entry_city; ?></td>
      <td><input type="text" name="city" value="<?php echo $city; ?>" class="large-field" /></td>
    </tr>
    <tr>
      <td><?php echo $entry_postcode; ?></td>
      <td><input type="text" name="postcode" value="<?php echo $postcode; ?>" class="large-field" /></td>
    </tr>
    <tr>
      <td><span class="required">*</span> <?php echo $entry_country; ?></td>
      <td><select name="country_id" class="large-field">
          <option value=""><?php echo $text_select; ?></option>
          <?php foreach ($countries as $country) { ?>
          <?php if ($country['country_id'] == $country_id) { ?>
          <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
          <?php } ?>
          <?php } ?>
        </select></td>
    </tr>
    <tr>
      <td><span class="required">*</span> <?php echo $entry_zone; ?></td>
      <td><select name="zone_id" class="large-field">
        </select></td>
    </tr>   
  </table>
  <table class="form" id="tbpengirim" style='display:none'>
   <tr>
      <td colspan="2"><h3><?php echo $pengirim; ?></h3></td>
    </tr>
    <tr>
      <td><span class="required">*</span> <?php echo $entry_name; ?></td>
      <td><input type="text" name="namapengirim" class="large-field" /></td>
    </tr>
    <tr>
      <td><span class="required">*</span> No HP. / Telp.:</td>
      <td><input type="text" name="hppengirim" class="large-field" /></td>
    </tr>
    </table>
</div>
<br />
<div class="buttons">
  <div class="right">
    <input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-addressb" class="button" />
  </div>
</div>
<script type="text/javascript">
$('#shipping-address input[name=\'shipping_address\']').live('change', function() {
	if (this.value == 'new') {
		$('#shipping-existing').hide();
		$('#shipping-new').show();
	} else {
		$('#shipping-existing').show();
		$('#shipping-new').hide();
	}
});

function showPropinsi232() {
var vlioo = $('#shipping-method select[name=\'country_id\']').val();
$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + vlioo,
		dataType: 'json',
		beforeSend: function() {
			$('#shipping-method select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#shipping-postcode-required').show();
			} else {
				$('#shipping-postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('#shipping-method select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
	}
	
$('#shipping-method select[name=\'country_id\']').bind('change', function() {
	if (this.value == '') return;	
	showPropinsi232();
});

var strio = '#shipping-method  .checkout-content input[name=\'';
$(strio+'jenispengiriman\']').live('change', function() {
	var namaii = '<?php echo $guest_name; ?>';
	var nohpii = '<?php echo $nohp; ?>';
	$(strio+'namapengirim\']').val('');
	$(strio+'hppengirim\']').val('');
	$(strio+'name\']').val('');
	$(strio+'hp\']').val('');
	if (this.value=='lain') {
		$('#tbpengirim').css('display','block' );
		$(strio+'hppengirim\']').val(nohpii);
		$(strio+'namapengirim\']').val(namaii);
	} else {
		$('#tbpengirim').css('display','none' );
		$(strio+'hp\']').val(nohpii);
		$(strio+'name\']').val(namaii);
		
	}
});

$('#shipping-method select[name=\'country_id\']').trigger('change');

$(document).ready(function() {
showPropinsi232();
});

$('#button-shipping-addressb').live('click', function() {
	$.ajax({
	url: 'index.php?route=checkout/shipping_address/validateb',
		type: 'post',
		data: $('#shipping-method input[type=\'text\'], #shipping-method input[type=\'password\'], #shipping-method input[type=\'checkbox\']:checked, #shipping-method input[type=\'radio\']:checked, #shipping-method select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-shipping-addressb').attr('disabled', true);
			$('#button-shipping-addressb').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-shipping-addressb').attr('disabled', false);
			$('.wait').remove();
		},	
		success: function(json) {
			$('.warning, .error').remove();
			if (json['redirect']) {
				location = json['redirect'];
			} else if (json['error']) {
				if (json['error']['warning']) {
					$('#shipping-method .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
					
					$('.warning').fadeIn('slow');
				}
								
				if (json['error']['name']) {
					$('#shipping-method input[name=\'name\']').after('<span class="error">' + json['error']['name'] + '</span>');
				}
								
				if (json['error']['hp']) {
					$('#shipping-method input[name=\'hp\']').after('<span class="error">' + json['error']['hp'] + '</span>');
				}		
							
				if (json['error']['city']) {
					$('#shipping-method input[name=\'city\']').after('<span class="error">' + json['error']['city'] + '</span>');
				}	
				
				
				if (json['error']['country']) {
					$('#shipping-method select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
				}	
				
				if (json['error']['zone']) {
					$('#shipping-method select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
				}
				
				if ($('#shipping-method #jenispengirimanlain').is(':checked')) {
					if (json['error']['iname']) {
						$('#shipping-method input[name=\'namapengirim\']').after('<span class="error">' + json['error']['iname'] + '</span>');
					}
								
					if (json['error']['ihp']) {
						$('#shipping-method input[name=\'hppengirim\']').after('<span class="error">' + json['error']['ihp'] + '</span>');
					}	
				}
			} else {
				$.ajax({
					url: 'index.php?route=checkout/shipping_method/inep',
					dataType: 'html',
					success: function(html) {
						$('#pilihJne .checkout-content').html(html);
						
						$('#shipping-method .checkout-content').slideUp('slow');
						
						$('#pilihJne .checkout-content').slideDown('slow');
						
						$('#shipping-method .checkout-heading a').remove();
						$('#pilihJne .checkout-heading a').remove();
						
						$('#shipping-method .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});	
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});
</script>