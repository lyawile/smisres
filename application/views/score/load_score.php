
<div class="col-md-12">
    <?php
    if (isset($messageError))
        echo $messageError;
    ?>
    <?php
    echo form_open_multipart('result/index');
    ?>
    <div class="col-md-6">
        <div class="form-group">
            <label for="stream">Select class</label>
            <select name="streamId" class="form-control" id="stream">
                <option value="1">Form 1</option>
                <option value="2">Form 2</option>
                <option value="3">Form 3</option>
                <option value="4">Form 4</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <label for="subjects">Select Subjects</label>
        <select id="subject" name="subjectName" class="form-control">
            <?php foreach ($result->result() as $dt) { ?>
                <option value="<?php echo $dt->subjectName ?>"><?php echo $dt->subjectName ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-12">
        <?php
        echo form_upload('scoreFile', '', 'class="form-control"');
        ?>
    </div>
    <div class="col-md-12">
        <button id="load_score" class="btn btn-primary" style="margin-top: 10px;">Load Scores</button>
    </div>
    <?php echo form_close() ?>
</div>

