<?php
$username = $this->session->userdata('username');
if (isset($username) && !empty($username)) {
    // stay silent for now, later will do something for our user.
} else {
    redirect('user/login');
}
?>
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
            <h3 style="display: inline">
                <?php echo anchor('student/register', 'SMIS') ?>
            </h3>
            <ul style="list-style: none ">
                <li>Hi, <?php echo $username ?></li>
                <li><a title="Click to see operations" href=""><span class="glyphicon glyphicon-user myuser" style="color: #e5edf4;"></span></a></li>
            </ul>
            <div class="dropMenu">
                <div class="arrow"></div>
                <ul>
                    <li><a href="">Profile</a></li>
                    <li><a href="">Change Password</a></li>
                    <li><?php echo anchor('user/logout', 'Logout'); ?></li>
                </ul>
            </div>
        </div>
        <div class="col-md-12 wrapper">
            <div class=" col-md-3 margin-control navigation list-group">
                <ul><?php $data = array('target' => '_blank') ?>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('student/register', 'Register student'); ?></li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('student/load', 'Load students') ?></li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('student/searchStudent', 'Edit Student details'); ?> </li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('student/viewStudents', 'View/Edit student Details'); ?> </li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('student/loadListView', 'students subjects'); ?> </li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('result/resultsGen', 'Generate Results'); ?> </li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('result/selectBatch', 'View Batch Results'); ?> </li> 
                    <li class="list-group-item list-group-item-action "><?php echo anchor('result/showResults', 'View PDF Results'); ?> </li> 
                    <li class="list-group-item list-group-item-action "><?php echo anchor('student/scoreTemplate', 'Get Score Template'); ?> </li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('result', 'Load Scores'); ?> </li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('user/register', 'Register Users'); ?> </li>
                    <li class="list-group-item list-group-item-action "><?php echo anchor('result_config/index', 'Change Term'); ?> </li>
                </ul> 
            </div>
            <div class="col-md-9 col-md-offset-3 margin-control">
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
                        //dataType: 'json',
                        type: 'POST',
                        data: {classId: classId},
                        url: "<?= base_url(); ?>" + "index.php/student/listStudent/" + classId,
                        success: function (data) {
                            console.log(data);
                            $('p').replaceWith(data);
                            if ($('p').length === 0) {
                                $('tr#dataIn').remove();
                                $('table tbody').append(data);
                            }
                        },
                        beforeSend: function (xhr) {
                            $('span.loader').replaceWith('<p class="load">Loading data ...</p>');
                        }

                    });
                });
                $('li.list-group-item').click(function (e) {

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
            $('#getTemp').on("click", function () {
                if ($(".sTemplate a").length !== 0) {
                    $(".sTemplate a").remove();
                }
                var subjectName = $('#subject').val();
                var stream = $("#stream").val();
                // alert("Selected stream is: "+ stream + " and the subject is: "+ subject);
                $.ajax({
                    url: "<?= base_url(); ?>" + "index.php/excel/getexcel/" + stream + "/" + subjectName,
                    success: function (data, textStatus, jqXHR) {
//                        alert(data);
                        if ($(".sTemplate a").length !== 0) {
                            $(".sTemplate a").remove();
                        } else {
                            var link = '<a href="<?= base_url(); ?>' + data + '.xlsx">Download ' + data + ' Template</a>';
                            $(".sTemplate").append(link);
                            $(".sTemplate span").remove()
                        }
                    },
                    beforeSend: function (xhr) {
                        $(".sTemplate").append("<span>Generating...</span>")
                    }
                });
            });
            $('li.classCode').click(function (e) {
                e.preventDefault();
                var classId = $(this).attr('id');
//                alert(classId); // for deburgging 
                $('li.active').removeClass('active');
                $(this).addClass('active');
                $('div.mylist').html("");
                $.ajax({
                    url: "<?= base_url(); ?>" + "index.php/student/listStudentSubjects/" + classId,
                    success: function (data, textStatus, jqXHR) {
                        $('div.mylist').html(data);
                    },
                    beforeSend: function (xhr) {
                        $('div.mylist').html("Generating the list");
                    }

                });

            });
            $(document).ready(function () {
                $(document).on('click', '.table a.changeSub', function (event) {
                    event.preventDefault();
                    $(this).closest('tr').addClass("clickedLink");
                    var studentId = $(this).attr('id');
                    var ids = $(".table tr.clickedLink input[id]");
                    //console.log(ids);
                    $.each(ids, function (i, v) {
                        var subject = $(v).attr('id');

                        if ($(v).is("input:checked")) {
                            var selectedSubject = v.val = 1;
                        } else {
                            selectedSubject = 0;
                        }
                        var subject = subject;
                        var selectedSubject = selectedSubject;
                        console.log(subject + "-" + studentId + " - " + selectedSubject);
                        $.ajax({
                            url: "<?= base_url(); ?>" + "index.php/student/changeSub/" + studentId + '/' + subject + '/' + selectedSubject,
                            success: function (data, textStatus, jqXHR) {
                                console.log(data);
                            },
                            beforeSend: function (xhr) {

                            }
                        });
                    });

                });
            });
            $('.myuser').click(function (e) {
                e.preventDefault();
                var x = $('.dropMenu').is(':visible');
                console.log(x);
                if (x == true) {
//                    console.log("ficha")
                    $('.dropMenu').css("display", "none");
                } else {
//                    console.log("Onesha")
                    $('.dropMenu').css("display", "block");
                }


            });
            $(document).ready(function () {
//                $('.error-mismatch').fadeOut(6000);
            }
            );



        </script>
    </body>
</html>


