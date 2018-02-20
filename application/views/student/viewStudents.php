<div class="col-md-12">
    <?php if (isset($delete_success)) echo $delete_success; ?>
    <h3>Select Class and stream</h3>
    <div class="form-group">
        <select id="classId" class="form-control">
            <?php foreach ($class->result() as $t) { ?>
                <option value="<?php echo $t->id ?>"><?php echo $t->streamName ?></option>
            <?php } ?>
        </select>
        <div>
            <table class="table">
                <tr>
                    <th>Registration</th>
                    <th>Full Name</th>
                    <th>Action</th>
                </tr>
                <tr class="removeit"><td></td></tr>
            </table>

        </div>
    </div>


</div>