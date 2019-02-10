<!--Headers for grades configurations--> 
<div class="row">
    <div class="col-xs-2">
        <label>Grade</label>
    </div>
    <div class="col-xs-5">
        <label>Low</label>
    </div>
    <div class="col-xs-5">
        <label>High</label>
    </div>
</div>
<?php foreach ($grades as $grades) {
    ?>

    <div class="row">
        <div class="col-xs-2">
            <input type="text" value="<?= $grades->grade ?>" class="form-control">
        </div>
        <div class="col-xs-5">
            <input type="text" value="<?= $grades->low ?>"  class="form-control">
        </div>
        <div class="col-xs-5">
            <input type="text" value="<?= $grades->high ?>"  class="form-control">
        </div>
    </div>
<?php } ?>
<div class="form-group">
    <br/>
    <button class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add interval</button>
</div>


</div>
<div class="box-footer">
    <?php echo form_submit('', 'Change grades', 'class="btn btn-primary"') ?>
</div>
