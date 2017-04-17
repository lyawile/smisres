<!DOCTYPE html>
<html>
    <head>
        <title>SMIS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/style.css"/>
    </head>
    <body>
        <div class="menu col-lg-12 col-md-12 col-sm-12">

        </div>
        <div class="col-lg-12 wrapper">
            <div class="col-lg-2 col-lg-offset-3 col-md-4 col-sm-12 margin-control">
                <ul>
                    <li><?php echo anchor('student/register', 'Register student'); ?></li>
                    <li><?php echo anchor('student/load', 'Load students') ?></li>
                    <li><?php echo anchor('student/searchStudent', 'Edit Student details'); ?> </li>
                    <li><?php echo anchor('student/viewStudents', 'View/Edit student Details'); ?> </li>
                </ul> 
            </div>
            <div class="col-lg-4  col-md-8 col-sm-12 margin-control">
                <?php if (isset($msg)) echo $msg; ?>

                <?php $this->load->view($content) ?>
            </div>
        </div>
        <script src="<?= base_url(); ?>public/js/jquery-3.1.1.js"></script>
        <script>
            $(document).ready(
                    function () {
                        $('#classId').change(function () {
                            var classId = $('#classId').val();
                            alert(classId);
                        });
                    }
            );
        </script>
    </body>
</html>


