
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Change Term</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
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
        </div>
    <?php } ?>
    <?php echo form_open('result_config/updateTerm', ['role' => 'form']) ?>
    <div class="checkbox">
        <label>
            <?php echo form_radio($data, $value = 'june', $checked = ($term === 'june') ? TRUE : FALSE); ?> June <br/>
        </label>

        <div class="checkbox">
            <label>
                <?php echo form_radio($data, $value = 'december', $checked = ($term === 'december') ? TRUE : FALSE); ?> December
            </label>
        </div>
        <div class="box-footer">
            <?php echo form_submit('', 'Change term', 'class="btn btn-primary"') ?>
        </div>
        <?php echo form_close() ?>
    </div>
</div>  
<!--Change the grade configurations--> 
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Change grades based on class</h3>
    </div>

    <form role="form">
        <div class="box-body">
            <div class="form-group">
                <label>Select class</label>
                <select id="classIdForGrades" class="form-control">
                    <option value="1">Form One</option>
                    <option value="2">Form Two</option>
                    <option value="3">Form Three</option>
                    <option value="4"> Form Four</option>
                </select>
            </div>
            <p class="display-grades"></p>

    </form>


</div>


