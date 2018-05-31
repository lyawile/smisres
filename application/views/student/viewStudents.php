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
                <thead>
                    <tr>
                        <th>Registration</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <span class="loader"></span>
                </tbody>

            </table>
        </div>
    </div>
</div>