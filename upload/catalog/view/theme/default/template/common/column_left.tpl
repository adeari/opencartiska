<?php if ($modules) { ?>
<div id="column-left">
  <?php foreach ($modules as $module) { ?>
  <?php echo $module; ?>
  <?php } ?>
  <div style="text-align:center">  
  
  <?php 
  $YMid1 = explode(",",$pinBB);
  $length1 = count($YMid1);
  for ($i=0;$i<$length1;$i++) {
  ?>
  <div style="height:20px">
  <div style="float:left"><img src="image/logo/bb.png" /></div> 
  <div style="float:left;margin-top:6px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $YMid1[$i]; ?></div>
  </div>
   <br/>
  <?php } ?>  
  <br/>
  
  <?php 
  $YMid1 = explode(",",$waNum);
  $length1 = count($YMid1);
  for ($i=0;$i<$length1;$i++) {
  ?>
  <div style="height:20px">
  <div style="float:left"><img src="image/logo/wa.png" /></div> 
  <div style="float:left;margin-top:6px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $YMid1[$i]; ?></div>
  </div>  
   <br/>
  <?php } ?>  
  <br/>
  
  <?php 
  $YMid1 = explode(",",$SMSnum);
  $length1 = count($YMid1);
  for ($i=0;$i<$length1;$i++) {
  ?>
  <div style="height:28px">
  <div style="float:left"><img src="image/logo/sms.png" /></div> 
  <div style="float:left;margin-top:12px">&nbsp;&nbsp;&nbsp;<?php echo  $YMid1[$i]; ?></div>
  </div>  
   <br/>
  <?php } ?>
  
   <?php  if ($showFBAcc) {  
  $YMid1 = explode(",",$YMid);
  $length1 = count($YMid1);
  for ($i=0;$i<$length1;$i++) {
  ?>
  <a href="ymsgr:sendIM?<?php echo $YMid1[$i]; ?>"><img src="http://opi.yahoo.com/online?u=<?php echo $YMid1[$i]; ?>&amp;m=g&amp;t=2" border="0"></a>
  <?php  } ?>
  <br/>
  <?php  } ?>
  
  
  </div>
</div>
<?php } ?> 
