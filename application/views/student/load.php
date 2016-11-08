<?php echo form_open_multipart('student/loadData') ?>
<?php echo form_upload('userfile','','class="form-control"') ?>
<?php echo form_submit('', 'upload file','class="submit"') ?>
<?php echo form_close()?>
