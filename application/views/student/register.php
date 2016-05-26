<?php  echo form_open('student/ingizaData'); ?>
<?php echo validation_errors();?>
<div class="form-group">
    <label for="firstname">Full Name</label>
    <?php 
    $data = array(
        'name'=> 'firstname',
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
            'value' => set_value('surname')
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
