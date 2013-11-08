<div id="shipping-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
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
      <td><input type="text" name="address_1" value="" class="large-field" /></td>
    </tr>
    <tr>
      <td><?php echo $entry_kecamatan; ?></td>
      <td><input type="text" name="kecamatan" value="" class="large-field" /></td>
    </tr>
    <tr>
      <td><span class="required">*</span> <?php echo $entry_city; ?></td>
      <td><input type="text" name="city" value="" class="large-field" /></td>
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
    <input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-address" class="button" />
  </div>
</div>
<script type="text/javascript"><!--
$('#shipping-address input[name=\'shipping_address\']').live('change', function() {
	if (this.value == 'new') {
		$('#shipping-existing').hide();
		$('#shipping-new').show();
	} else {
		$('#shipping-existing').show();
		$('#shipping-new').hide();
	}
});
//--></script> 
<script type="text/javascript"><!--

function showPropinsi232() {
var vlioo = $('#shipping-method select[name=\'country_id\']').val();
$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + vlioo,
		dataType: 'json',
		beforeSend: function() {
			$('#shipping-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
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

$('#shipping-address select[name=\'country_id\']').trigger('change');

$(document).ready(function() {
showPropinsi232();
});
//--></script>