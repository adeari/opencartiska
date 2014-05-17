<?php if ($modules) { ?>
<div id="column-left">
  <?php foreach ($modules as $module) { ?>
  <?php echo $module; ?>
  <?php } ?>
  <div class="boxLogin">
  <div class="box">
  <div class="box-heading"><?php echo $contact_us ?></div>
  <div class="boxContactUs">
    <br/>
  <?php 
  $YMid1 = explode(",",$pinBB);
  $length1 = count($YMid1);
  if ($length1) { ?>
  <table border="0" cellpadding="0" cellspacing="0" height="1" width="100%">
	<tbody>
  <?php for ($i=0;$i<$length1;$i++) {
  	?>
  <tr>
  	<td height=1 width=20><img src="image/logo/bb.png" /></td>
  	<td height=1 width=75> Pin BB : </td>
  	<td align="right"><?php echo $YMid1[$i]; ?></td>
  </tr> 
  <?php  } ?>
  </tbody>
  </table>  
  <?php } ?>
  <br/>

  <?php 
  $YMid1 = explode(",",$waNum);
  $length1 = count($YMid1);
  if ($length1) { ?>
  <table border="0" cellpadding="0" cellspacing="0" height="1" width="100%">
	<tbody>
  <?php for ($i=0;$i<$length1;$i++) {
  	?>
  <tr>
  	<td height=1 width=20><img src="image/logo/wa.png" /></td>
  	<td height=1 width=75> Whatsapp : </td>
  	<td align="right"><?php echo $YMid1[$i]; ?></td>
  </tr> 
  <?php  } ?>
  </tbody>
  </table>  
  <?php } ?>
  <br/>
  
  <?php 
  $YMid1 = explode(",",$SMSnum);
  $length1 = count($YMid1);
  if ($length1) { ?>
  <table border="0" cellpadding="0" cellspacing="0" height="1" width="100%">
	<tbody>
  <?php for ($i=0;$i<$length1;$i++) {
  	?>
  <tr>
  	<td height=1 width=20><img src="image/logo/sms.png" /></td>
  	<td height=1 width=75> SMS : </td>
  	<td align="right"><?php echo $YMid1[$i]; ?></td>
  </tr> 
  <?php  } ?>
  </tbody>
  </table>  
  <?php } ?>
  <br/>
  
   <?php  if ($showFBAcc) {  
  $YMid1 = explode(",",$YMid);
  $length1 = count($YMid1);
  if ($length1) { ?>
  <table border="0" cellpadding="0" cellspacing="0" height="1" width="100%">
<tbody>
  <?php for ($i=0;$i<$length1;$i++) {
  	$NumChr = 65+$i;
  ?>
  <tr><td height=1 >Contact ym <?php  echo chr($NumChr); ?> : </td><td height=1 align="right">
  <a href="ymsgr:sendIM?<?php echo $YMid1[$i]; ?>"><img style="height:18px" src="http://opi.yahoo.com/online?u=<?php echo $YMid1[$i]; ?>&amp;m=g&amp;t=1" border="0"></a>
</td></tr> 
  <?php  } ?>
  </tbody>
  </table>  
  <?php }?>
  <?php  } ?>
  
  </div></div></div>
</div>
<?php } ?> 
