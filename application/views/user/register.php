<?php
echo form_open("user/register");
?>
<div class="alert-warning" style="width: 100%; height: 40px; line-height: 40px; padding-left: 15px; margin-bottom: 10px; ">
    Please, register the user to the required group!!!!!!!!
</div>
<?php if (isset($success)) echo $success; // displays the user successful registration message?> 
<div class="form-group col-md-4">
    <span class="error-message"><?php echo form_error('firstname'); ?></span>
    <span class="error-message"><?php if (isset($username)) echo $username; ?></span>
    <label for="firstname">First Name</label>
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
<div class="form-group col-md-4">
    <span class="error-message"><?php echo form_error('middlename'); ?></span>
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
<div class="form-group col-md-4">
    <span class="error-message"><?php echo form_error('surname'); ?></span>
    <label for="surname">Surname</label>
    <?php
    $data = array(
        'name' => 'surname',
        'placeholder' => 'Enter Surname',
        'class' => 'form-control',
        'id' => 'surname',
        'value' => set_value('surname')
    );
    echo form_input($data);
    ?>
</div>

<div class="form-group col-md-4">
    <span class="error-message"></span>
    <label for="studentSearch">Gender</label>
    <select class="form-control" name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
</div>
<div class="form-group col-md-4">
    <span class="error-message"></span>
    <label for="group">Select User Category</label>
    <select class="form-control" name="group">
        <?php foreach ($user_category->result() as $cat) { ?>
            <option value="<?php echo $cat->id ?>"><?php echo $cat->group; ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group col-md-4">
    <span class="error-message"><?php echo form_error('username'); ?></span>
    <label for="username">Username</label>
    <?php
    $data = array(
        'name' => 'username',
        'placeholder' => 'Enter Username',
        'class' => 'form-control',
        'id' => 'username',
        'value' => set_value('username')
    );
    echo form_input($data);
    ?>
</div>
<div class="form-group col-md-6">
    <span class="error-message"><?php echo form_error('password'); ?></span>
    <label for="studentSearch">Password</label>
    <?php
   // $setValueForPassword = set_value('password');
  //  echo $passwordValue = (isset($setValueForPassword) && !empty($setValueForPassword)) ? $setValueForPassword : $password;
    $data = array(
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'Enter Password',
        'class' => 'form-control',
        'id' => 'password',
//        'value' => set_value('password')
        'value' => set_value('password')
    );
    echo form_input($data);
    ?>
</div>
<div class="form-group col-md-6">
    <span class="error-message"><?php echo form_error('cpassword'); ?></span>
    <label for="studentSearch">Confirm Password</label>
    <?php
    $data = array(
        'name' => 'cpassword',
        'type' => 'password',
        'placeholder' => 'Retype password',
        'class' => 'form-control',
        'id' => 'cpassword',
        'value' => set_value('cpassword')
    );
    echo form_input($data);
    ?>
</div>
<div class="form-group col-md-6">
    <input type="submit" class="btn btn-primary" value="Register user"/>
</div>
<?php echo form_close(); ?>



