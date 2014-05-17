<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
        <?php if ($isEdited) { ?>
        <tr>
            <td><span class="required">*</span>Nomor resi</td>
            <td><?php echo $noresi;?></td>
          </tr>
        <?php } else {?>
        <tr>
            <td><span class="required">*</span>Nomor resi</td>
            <td>
              <input type="text" id="noresi" name="noresi" value="<?php echo $noresi;?>"/>
             </td>
          </tr>
          <?php } ?>
          <tr>
            <td><span class="required">*</span>Tanggal</td>
            <td>
              <input type="text" id="tanggal" name="tanggal" value="<?php echo $tanggal;?>" size="12"/>
             </td>
          </tr>
          <tr>
            <td><span class="required">*</span>Nama</td>
            <td>
              <input type="text" id="nama" name="nama" value="<?php echo $nama;?>"/>
             </td>
          </tr>          
          <tr>
            <td><span class="required">*</span>Kurir</td>
            <td>
              <input type="text" id="kurir" name="kurir" value="<?php echo $kurir;?>"/>
             </td>
          </tr>
        </table>        
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#tanggal').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer; ?>