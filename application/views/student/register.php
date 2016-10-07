
<?php date_default_timezone_set('Africa/Dar_es_Salaam'); ?>
<?php echo form_open_multipart('student/ingizaData'); ?>
<?php echo $successMessage; ?>
<div class="form-group">
    <span><?php echo form_error('firstname') ?></span>
    <label for="firstname">Full Name</label>
    <?php
    $data = array(
        'name' => 'firstname',
        'placeholder' => 'Enter First Name',
        'class' => 'form-control',
        'id' => 'firstname',
        'value' => set_value('firstname')
    );

    echo form_input($data);
    ?>
</div>
<div class="form-group">
    <span><?php echo form_error('middlename') ?></span>
    <label for="middlename">Middle Name</label>
    <?php
    $data = array(
        'name' => 'middlename',
        'placeholder' => 'Enter Middle Name',
        'class' => 'form-control',
        'id' => 'middlename',
        'value' => set_value('middlename')
    );
    echo form_input($data);
    ?>
</div>
<div class="form-group">
    <span><?php echo form_error('surname') ?></span>
    <label for="fullname">Last Name</label>
    <?php
    $data = array(
        'name' => 'surname',
        'placeholder' => 'Enter Last Name',
        'class' => 'form-control',
        'id' => 'fullname',
        'value' => set_value('surname')
    );
    echo form_input($data);
    ?>

</div>
<div class="form-group">
    <span><?php echo form_error('vision') ?></span>
    <label for="impairment">Disability information</label>
    <select class="form-control" name="vision">
        <option value="1">Blind</option>
        <option value="2">Low vision</option>
        <option selected="" value="0">Normal</option>
    </select>

</div>
<div class="form-group">
    <label>Gender</label>
    <div class="radio">
        <?php
        $data = array(
            'name' => 'gender',
            'class' => '',
            'value' => 'male',
            'checked' => TRUE
        );
        echo '<label>' . form_radio($data) . ' Male</label>';
        ?>
    </div>
    <div class="radio">
        <?php
        $data = array(
            'name' => 'gender',
            'class' => '',
            'value' => 'female',
            'checked' => TRUE
        );
        echo '<label>' . form_radio($data) . 'Female</label>';
        ?>
    </div>
</div>
<input type="hidden" name="date" value="<?php echo date('Y-m-d : H:i:s') ?>" />
<div class="form-group">
    <span><?php echo form_error('dateOfBirth') ?></span>
    <label for="dateofbirth" style="display: block">Date of Birth</label>
    <input type="date" name="dateOfBirth" />  
</div>
<div class="form-group">
    <span><?php echo form_error('address') ?></span>
    <label for="address">Address</label>
    <?php
    $data = array(
        'name' => 'address',
        'placeholder' => 'Enter an Address',
        'class' => 'form-control',
        'id' => 'address',
        'value' => set_value('address')
    );
    echo form_input($data);
    ?>

</div>
<div class="form-group">
    <span><?php echo form_error('phonenumber') ?></span>
    <label for="phonenumber">Phone Number</label>
    <?php
    $data = array(
        'name' => 'phonenumber',
        'placeholder' => 'Enter Phone Number',
        'class' => 'form-control',
        'id' => 'phonenumber',
        'value' => set_value('phonenumber')
    );
    echo form_input($data);
    ?>

</div>
<div class="form-group">
    <span><?php echo form_error('pic') ?></span>
    <label for="pic">Upload Picture</label>
    <?php
    $data = array(
        'name' => 'pic',
        'placeholder' => 'Upload File',
        'class' => 'form-control',
        'id' => 'pic',
        'value' => set_value('pic')
    );
    echo form_upload($data);
    ?>

</div>
<!--<div class="form-group">
    <span style="display: block;"><p><?php echo $error ?></p></span>
    <label for="phonenumber">Upload Picture</label>
    <input type="file" name="userfile" />
</div>-->
<div class="form-group">

    <?php
    $data = array(
        'class' => 'btn btn-info',
        'value' => 'submit data'
    );
    echo form_submit($data);
    ?>
</div>
<?php echo form_close(); ?>
