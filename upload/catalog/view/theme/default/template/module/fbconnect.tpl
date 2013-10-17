<style type="text/css">
.box.box-fbconnect .box-content .box-fbconnect-a {
	height: 40px;
	width: 182px;
	margin-bottom: 5px;
	background:url(image/templates/facebuton1.fw.png) bottom;
	text-indent: -99999px;
	outline: none;
}


.box.box-fbconnect {
	height: auto;
	width: auto;
	display: block;
	line-height: 20px;
	font-weight: bolder;
	color: #FFF;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	-khtml-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
	border: 1px solid #EEEEEE;
}
.box.box-fbconnect .box-content .box-fbconnect-a:hover {
	background-position: 0 0;
}
.box.box-fbconnect .box-content .box-fbconnect-a {
	float: left;
	margin-left:30px;
}
.box-content11 {
	height:48px;
	padding:10px;
}
</style>
<div class="box box-fbconnect">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content box-content11">
	<a class="box-fbconnect-a" href="<?php echo $fbconnect_url; ?>"><?php echo $fbconnect_button; ?></a>
  </div>
</div>