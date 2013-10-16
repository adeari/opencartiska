<?php if ($modules) { ?>
<div id="column-left">
  <?php foreach ($modules as $module) { ?>
  <?php echo $module; ?>
  <?php } ?>
  <div style="text-align:center">
  <?php if ($showFBAcc) { ?>  
  <a href="ymsgr:sendIM?iska_nk"><img src="http://opi.yahoo.com/online?u=iska_nk&amp;m=g&amp;t=15" border="0"></a>
  <br/>
  iska_nk<br/><br/>
  <?php } ?>
  
  <div style="height:20px">
  <div style="float:left"><img src="image/logo/bb.png" /></div> 
  <div style="float:left;margin-top:6px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pinBB; ?></div>
  </div>
  <br/><br/>
  <div style="height:20px">
  <div style="float:left"><img src="image/logo/wa.png" /></div> 
  <div style="float:left;margin-top:6px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $waNum; ?></div>
  </div>
  <br/><br/>
  <div style="height:30px">
  <div style="float:left"><img src="image/logo/sms.png" /></div> 
  <div style="float:left;margin-top:12px">&nbsp;&nbsp;&nbsp;0788565</div>
  </div>
  <br/><br/>
  </div>
  <?php if ($showFBAcc) { ?>  
  <div style="text-align:center">
  <a href="https://www.facebook.com/mf.shoppu/photos_albums" target="_TOP" title="MF Shoppu Collextionz"><img src="https://badge.facebook.com/badge/100003348899196.555.1978900028.png" style="border: 0px;"></a>
  <br/><br/>
  </div>
  <?php } ?>
  
  

</div>
<?php } ?> 
