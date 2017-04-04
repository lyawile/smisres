<?php  ?>  
<?php date_default_timezone_set('Africa/Dar_es_Salaam'); ?>
<?php if (isset($successMessage)) echo $successMessage; ?>
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
        'name'=> 'submit',
        'class' => 'form-control',
        'value' => 'search',
          'id' => 'search'
    );
    echo form_submit($data);
    ?>
</div>
<?php echo form_close(); ?>
<hr/>
<div class="form-group">
    <span class="error-message"><?php echo form_error('middlename') ?></span>
    <label for="fullname">First Name</label>
    <input type="text" name="surname" value="<?php if (isset($firstname)) echo $firstname; ?>" class="form-control" id="fullname"  />
</div>
<div class="form-group">
    <span class="error-message"><?php echo form_error('middlename') ?></span>
    <label for="fullname">Middle Name</label>
    <input type="text" name="surname" value="<?php if (isset($middlename)) echo $middlename; ?>" class="form-control" id="fullname"  />
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
        <option value="<?php if(isset($vision) && $vision == 1) echo 1?>" <?php if(isset($vision) && $vision == 1) echo "selected"?>>Blind</option>
        <option value="<?php if(isset($vision) && $vision == 2) echo 2?>" <?php if(isset($vision) && $vision == 2) echo "selected" ?>>Low vision</option>
        <option  value="<?php if(isset($vision) && $vision == 0) echo 0?>" <?php if(isset($vision) && $vision == 0) echo "selected" ?>>Normal</option>
    </select>

</div>
<div class="form-group">
    <label>Gender</label>
    <div class="radio">
        <label><input type="radio" name="gender" value="male" <?php if(isset($gender) && $gender !== "" && $gender === "male") echo "checked" ?> class=""> Male</label>   
    </div>
    <div class="radio">
        <label><input type="radio" name="gender" value="male" <?php if(isset($gender) && $gender !== "" && $gender === "female") echo "checked" ?> class=""> Female</label>   
    </div>
</div>

<input type="hidden" name="date" value="<?php echo date('Y-m-d : H:i:s') ?>" />
<div class="form-group">
    <span class="error-message"><?php echo form_error('dateOfBirth') ?></span>
    <label for="dateofbirth" style="display: block">Date of Birth</label>
    <input type="date" name="dateOfBirth" value="2015-10-25" />  
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
        'value' => set_value('address')
    );
    echo form_input($data);
    ?>

</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('phonenumber') ?></span>
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
    <span class="error-message"><?php echo form_error('stdSeven') ?></span>
    <label for="stdSeven">Standard Seven School</label>
    <?php
    $data = array(
        'name' => 'stdSeven',
        'placeholder' => 'Enter Standard Seven School',
        'class' => 'form-control',
        'id' => 'stdSeven',
        'value' => set_value('stdSeven')
    );
    echo form_input($data);
    ?>

</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('stdSevenYear') ?></span>
    <label for="stdSevenYear">Standard Seven Year</label>
    <?php
    $data = array(
        'name' => 'stdSevenYear',
        'placeholder' => 'Enter Standard Seven Year',
        'class' => 'form-control',
        'id' => 'stdSevenYear',
        'value' => set_value('stdSevenYear')
    );
    echo form_input($data);
    ?>

</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('medium') ?></span>
    <label for="medium">Standard Seven Medium</label>
    <select class="form-control" id="medium" name="medium">
        <option value="English">English</option>
        <option selected="" value="Swahili">Swahili</option>
    </select>
</div>

<div class="form-group">
    <span class="error-message" ><?php echo form_error('pic') ?></span>
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
