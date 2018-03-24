<div class="col-md-12">
    <div class="col-md-6">
        <div class="form-group">
            <label for="stream">Select class</label>
            <select class="form-control" id="stream">
                <option value="1">Form 1</option>
                <option value="2">Form 2</option>
                <option value="3">Form 3</option>
                <option value="4">Form 4</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <label for="subjects">Select Subjects</label>
        <select id="subject" class="form-control">
        <?php foreach ($result->result() as $dt ){ ?>
            <option value="<?php echo $dt->subjectID ?>"><?php echo $dt->subjectName ?></option>
        <?php } ?>
            </select>
    </div>
    <div class="col-md-12 sTemplate">
           <button id="getTemp" class="btn btn-primary">Get template</button>
    </div>
</div>

