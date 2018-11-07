<?php
$data = array(
    'name' => 'term'
);
?>
<?php
if ($result == "OK") {
    ?>
    <div class="alert alert-success">
        <strong>Term changed successfully!</strong> 
    </div
<?php } ?>
<?php echo form_open('result_config/updateTerm') ?>
<?php echo form_radio($data, $value = 'june', $checked = ($term === 'june') ? TRUE : FALSE); ?> June <br/>
<?php echo form_radio($data, $value = 'december', $checked = ($term === 'december') ? TRUE : FALSE); ?> December <br/>
<?php echo form_submit('', 'upload file', 'class="submit" style="display: inline !important; margin-right: 20px;"') ?>
<?php
echo form_close()?>