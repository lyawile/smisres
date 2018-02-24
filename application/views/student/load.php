<?php 
$url = base_url().'files/templates/smis _template.xlsx';
?>
<?php echo form_open_multipart('excel/loadData') ?>
<?php echo form_upload('userfile','','class="form-control"') ?>
<?php echo form_submit('', 'upload file','class="submit" style="display: inline !important; margin-right: 20px;"') ?>
<?php echo anchor( $url, 'Download Template') ?>
<?php echo form_close()?>