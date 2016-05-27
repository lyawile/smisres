<?php echo form_open('student/ingizaData'); ?>
<?php echo validation_errors(); ?>
<div class="form-group">
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
    <label for="fullname">Full Name</label>
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
    <label>Gender</label>
    <div class="radio">
    <?php
    $data = array(
        'name' => 'gender',
        'class' => '',
        'value' => 'male',
        'checked' => TRUE
    );
    echo '<label>'.form_radio($data).' Male</label>';
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
    echo '<label>'.form_radio($data).'Female</label>';
    ?>
</div>
</div>
<input type="hidden" name="date" value="<?php echo date('Y-m-d : H:m:s') ?>" />
<div class="form-group">
    <label for="dateofbirth" style="display: block">Date of Birth</label>
    <input type="date" name="dateOfBirth" />  
</div>
<div class="form-group">
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

    <?php
    $data = array(
        'class' => 'btn btn-info',
        'value' => 'submit data'
    );
    echo form_submit($data);
    ?>
</div>


<?php echo form_close(); ?>
