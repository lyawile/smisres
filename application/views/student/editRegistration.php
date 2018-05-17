<?php date_default_timezone_set('Africa/Dar_es_Salaam'); ?>
<?php if (isset($success_update)) echo $success_update; ?>
<?php echo form_open('student/searchStudent') ?>
<div class="form-group">
    <span class="error-message"></span>
    <label for="studentSearch">Student Search</label>
    <?php
    $data = array(
        'name' => 'studentId',
        'placeholder' => 'Enter student Number',
        'class' => 'form-control',
        'id' => 'studentSearch',
        'value' => set_value('studentId')
    );
    echo form_input($data);
    ?>

</div>
<div class="form-group">
    <?php
    $data = array(
        'name' => 'submit',
        'class' => 'form-control',
        'value' => 'search',
        'id' => 'search'
    );
    echo form_submit($data);
    ?>
</div>
<?php echo form_close(); ?>
<hr/>
<?php
$id = array('id' => "$studentId");

echo form_open_multipart('student/edit', '', $id)
?>
<div class="form-group">
    <span class="error-message"><?php echo form_error('middlename') ?></span>
    <label for="fullname">First Name</label>
    <input type="text" name="firstname" value="<?php if (isset($firstname)) echo $firstname; ?>" class="form-control" id="fullname"  />
</div>
<div class="form-group">
    <span class="error-message"><?php echo form_error('middlename') ?></span>
    <label for="fullname">Middle Name</label>
    <input type="text" name="middlename" value="<?php if (isset($middlename)) echo $middlename; ?>" class="form-control" id="fullname"  />
</div>

<div class="form-group">
    <span class="error-message"><?php echo form_error('surname') ?></span>
    <label for="fullname">Last Name</label>
    <input type="text" name="surname" value="<?php if (isset($username)) echo $username; ?>" class="form-control" id="fullname"  />
</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('vision') ?></span>
    <label for="impairment">Disability information</label>
    <select class="form-control" name="vision">
        <option  value="1"  <?php if (isset($vision) && $vision == 1) echo "selected" ?>>Blind</option>
        <option value="2"  <?php if (isset($vision) && $vision == 2) echo "selected" ?>>Low vision</option>
        <option value="0"  <?php if (isset($vision) && $vision == 0) echo "selected" ?>>Normal</option>
    </select>

</div>
<div class="form-group">
    <label>Gender</label>
    <div class="radio">
        <label><input type="radio" name="gender" value="1" <?php if ($gender === "1") echo "checked"; ?> class=""> Male</label>   
    </div>
    <div class="radio">
        <label><input type="radio" name="gender" value="2" <?php if ($gender === "2") echo "checked"; ?> class=""> Female</label>   
    </div>
</div>

<input type="hidden" name="dateRegistered" value="<?php echo $dateRegistered; ?>" />
<div class="form-group">
    <span class="error-message"><?php echo form_error('dateOfBirth') ?></span>
    <label for="dateofbirth" style="display: block">Date of Birth</label>
    <?php
    $data = array(
        'type' => 'date',
        'name' => 'birthDate',
        'value' => $birthDate
    );
    echo form_input($data);
    ?>
</div>

<div class="form-group">
    <span class="error-message"><?php echo form_error('address') ?></span>
    <label for="address">Address</label>
    <?php
    $data = array(
        'name' => 'address',
        'placeholder' => 'Enter an Address',
        'class' => 'form-control',
        'id' => 'address',
        'value' => $address = isset($address) ? $address : set_value()
    );
    echo form_input($data);
    ?>

</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('phoneNumber') ?></span>
    <label for="phonenumber">Phone Number</label>
    <?php
    $data = array(
        'name' => 'phoneNumber',
        'placeholder' => 'Edit Phone Number',
        'class' => 'form-control',
        'id' => 'phoneNumber',
        'value' => set_value('phoneNumber', $phoneNumber)
    );
    echo form_input($data);
    ?>

</div>

<div class="form-group">
    <span class="error-message"><?php echo form_error('stdSeven') ?></span>
    <label for="stdSeven">Standard Seven School</label>
    <?php
    $data = array(
        'name' => 'standardSeven',
        'placeholder' => 'Enter Standard Seven School',
        'class' => 'form-control',
        'id' => 'stdSeven',
        'value' => set_value('stdSeven', $standardSeven)
    );
    echo form_input($data);
    ?>

</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('stdSevenYear') ?></span>
    <label for="stdSevenYear">Standard Seven Year</label>
    <?php
    $data = array(
        'name' => 'year',
        'placeholder' => 'Enter Standard Seven Year',
        'class' => 'form-control',
        'id' => 'stdSevenYear',
        'value' => set_value('stdSevenYear', $year)
    );
    echo form_input($data);
    ?>

</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('medium') ?></span>
    <label for="medium">Standard Seven Medium</label>
    <select class="form-control" id="medium" name="medium">
        <option value="English" <?php if ($medium == 'English') echo "selected"; ?>>English</option>
        <option value ="Swahili" <?php if ($medium == 'Swahili') echo "selected"; ?>>Swahili</option>
    </select>
</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('pic') ?></span>
    <label for="pic">Change Picture</label>
    <?php
    $data = array(
        'name' => 'picUrl',
        'placeholder' => 'Upload File',
        'class' => 'form-control',
        'id' => 'pic',
        'value' => set_value($picUrl)
    );
    echo form_upload($data);
    ?>
    <img src="<?php echo base_url() . 'files/' . $picUrl ?>"/>
    <?php echo form_hidden('picUrl', $picUrl); ?>
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
