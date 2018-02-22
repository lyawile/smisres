<!DOCTYPE html>
<html>
    <head>
        <title>SMIS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/style.css"/>
        <style>
        </style>
    </head>
    <body>
        <div class="menu col-lg-12 col-md-12 col-sm-12">

        </div>
        <div class="col-lg-12 wrapper">
            <div class="col-lg-2 col-lg-offset-3 col-md-4 col-sm-12 margin-control">
                <ul><?php $data=array('target'=>'_blank') ?>
                    <li><?php echo anchor('student/register', 'Register student'); ?></li>
                    <li><?php echo anchor('student/load', 'Load students') ?></li>
                    <li><?php echo anchor('student/searchStudent', 'Edit Student details'); ?> </li>
                    <li><?php echo anchor('student/viewStudents', 'View/Edit student Details'); ?> </li>
                    <li><?php echo anchor('handlepdf/show', 'View Results', $data); ?> </li>
                    <li><?php echo anchor('student/scoreTemplate', 'Get Score Template'); ?> </li>
                </ul> 
            </div>
            <div class="col-lg-4  col-md-8 col-sm-12 margin-control">
                <?php if (isset($msg)) echo $msg; ?>

                <?php $this->load->view($content) ?>
            </div>
        </div>
        <script src="<?= base_url(); ?>public/js/jquery-3.1.1.js"></script>
        <script>
            $(document).ready(function () {
                $('#classId').change(function () {
                    var classId = $('#classId').val();
                    $.ajax({
                        dataType: 'json',
                        type: 'POST',
                        data: {classId: classId},
                        url: "<?= base_url(); ?>" + "student/listStudent/" + classId,
                        success: function (data) {
                            console.log(data);
                            // var parsed = JSON.parse(data);
//                                    console.log(parsed[0].firstname);
                            var student_data = '';
                            var parsed = data;
                            $(parsed).each(function (i, k) {
                                student_data += '<tr>';
                                student_data += '<td>' + parsed[i].id + '</td>'
                                student_data += '<td>' + parsed[i].firstname + ' ' + parsed[i].middlename + ' ' + parsed[i].surname + ' (' + parsed[i].gender + ')' + '</td>';
                                student_data += '<td><a  href="searchStudent/' + parsed[i].id + '">Edit</a> |<a id="delete" onclick="return deleteStudent(this)"  href="delete/' + parsed[i].id + '"> Delete</a></td>';
                                student_data += '<tr>';
                            });
                            $('p').replaceWith(student_data);
                        },
                        beforeSend: function (xhr) {
                            $('tr.removeit').replaceWith('<p>Loading data ...</p>');
                        }

                    });
                });
            }
            );
            function deleteStudent(e) {
                var activeLink = $(e).attr('href');
                var con = confirm("Are you sure you want to delete?");
                if (con == true) {
                    alert("the record to delete is no: " + activeLink);
                    $.ajax({
                        url: "<?= base_url(); ?>" + "student/" + activeLink,
                        success: function (data, textStatus, jqXHR) {
                            alert(data);
                            location.reload();

                        }
                    });
                }
                return false;
            }
        </script>
    </body>
</html>


