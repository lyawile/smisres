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
        <div class="col-md-12 wrapper">
            <div class=" col-md-3 margin-control">
                <ul><?php $data = array('target' => '_blank') ?>
                    <li><?php echo anchor('student/register', 'Register student'); ?></li>
                    <li><?php echo anchor('student/load', 'Load students') ?></li>
                    <li><?php echo anchor('student/searchStudent', 'Edit Student details'); ?> </li>
                    <li><?php echo anchor('student/viewStudents', 'View/Edit student Details'); ?> </li>
                    <li><?php echo anchor('student/loadListView', 'students subjects'); ?> </li>
                    <li><?php echo anchor('handlepdf/show', 'View Results', $data); ?> </li>
                    <li><?php echo anchor('student/scoreTemplate', 'Get Score Template'); ?> </li>
                </ul> 
            </div>
            <div class="col-md-9 margin-control">
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
                        url: "<?= base_url(); ?>" + "student/listStudent/" + classId,
                        success: function (data) {
                            console.log(data);
                            //$('#dataIn').load(document.URL + ' #dataIn');
                            //console.log(classId);
                            // var parsed = JSON.parse(data);
//                                    console.log(parsed[0].firstname);
//                            var student_data = '';
//                            var parsed = data;
//                            $(parsed).each(function (i, k) {
//                                student_data += '<tr id="dataIn">';
//                                student_data += '<td>' + parsed[i].id + '</td>'
//                                student_data += '<td>' + parsed[i].firstname + ' ' + parsed[i].middlename + ' ' + parsed[i].surname + ' (' + parsed[i].gender + ')' + '</td>';
//                                student_data += '<td><a  href="searchStudent/' + parsed[i].id + '">Edit</a> |<a id="delete" onclick="return deleteStudent(this)"  href="delete/' + parsed[i].id + '"> Delete</a></td>';
//                                student_data += '<tr>';
//                            });
                            $('p').replaceWith(data);
                            if ($('p').length === 0) {
                                $('tr#dataIn').remove();
                                $('table').append(data);
                            }
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
            $('#getTemp').on("click", function () {
                if ($(".sTemplate a").length !== 0) {
                    $(".sTemplate a").remove();
                }
                var subjectId = $('#subject').val();
                var stream = $("#stream").val();
                // alert("Selected stream is: "+ stream + " and the subject is: "+ subject);
                $.ajax({
                    url: "<?= base_url(); ?>" + "index.php/excel/getexcel/" + stream + "/" + subjectId,
                    success: function (data, textStatus, jqXHR) {
                        if ($(".sTemplate a").length !== 0) {
                            $(".sTemplate a").remove();
                        } else {
                            var link = '<a href="<?= base_url(); ?>hello world.xlsx">Download Score Template</a>';
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
                    url: "<?= base_url(); ?>" + "student/listStudentSubjects/" + classId,
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
                    var studentId = $(this).attr('id');
                    var ids = $(".table input[id]");
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
                        console.log(subject + "-" + studentId + " - "+ selectedSubject);
                        $.ajax({
                            url: "<?= base_url(); ?>" + "student/changeSub/" + studentId +'/'+ subject+'/'+selectedSubject ,
                            success: function (data, textStatus, jqXHR) {
                                console.log(data);
                            },
                            beforeSend: function (xhr) {
                                    
                            }
                        });
                    });

                });
            });

        </script>
    </body>
</html>


