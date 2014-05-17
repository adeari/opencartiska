<div class="boxLogin">
<div class="box">
  <div class="box-heading">
  <?php echo $text_returning_customer; ?></div>
  <div class="boxForm">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <?php echo $entry_email; ?>
    <input class="widthLoginInput" type="text" name="email" value="<?php echo $email; ?>" />
    <?php echo $entry_password; ?>
    <input type="password" class="widthLoginInput" name="password" value="<?php echo $password; ?>" />
    <br />
    <a class="rightForgetEmail" href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
    <input type="submit" value="<?php echo $button_login; ?>" class="button" />
  </form>
  
  <div class="box box-fbconnect">
  <div class="box-content box-content11">
	<a class="box-fbconnect-a" href="<?php echo $fbconnect_url; ?>"><?php echo $fbconnect_button; ?></a>
  </div></div>
  
  </div>
  </div>
</div>
