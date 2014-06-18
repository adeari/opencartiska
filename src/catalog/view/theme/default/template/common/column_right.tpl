<?php if ($modules) { ?>
<div id="column-right">
  
  
<?php echo $modules[0]; ?>
  <div id="KeranjangBelanja" style="margin:10px 0 10px 0"><?php echo $keranjangBelanja; ?></div>
  <?php if (isset($modules[1]))echo $modules[1]; ?>
 <div style="text-align:center"> 
  <?php if ($showFBAcc) { ?>  
  <div style="text-align:center">
  <a href="https://www.facebook.com/mf.shoppu/photos_albums" target="_TOP" title="MF Shoppu Collextionz"><img src="https://badge.facebook.com/badge/100003348899196.555.1978900028.png" style="border: 0px;"></a>

  </div>
  <?php } ?>
 </div>
</div>
<?php } ?>
