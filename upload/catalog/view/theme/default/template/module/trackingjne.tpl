<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content" style="text-align: center">
    <div>
    <a href="http://www.jne.co.id" target="_blank"><img src="/image/logo/jne.png" border="0"></a>
    </div>
    <?php echo $entry_resi; ?> : 
    <input id="trackingjne" type="text" name="trackingjne" style="width: 150px;"><br />&nbsp;

<script type="text/javascript">
<!--
$('#trackingjne').bind('keypress', function(e) {
	if(e.keyCode==13){
      window.open('http://jne.co.id/index.php?mib=tracking.detail&awb=' + this.value);
	}
});
-->
</script>

  </div>
</div>
