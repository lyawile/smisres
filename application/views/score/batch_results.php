<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/style.css"/>
    </head>
    <body>
        <div style="text-align: center">
            <h2>MTWARA ISLAMIC SECONDARY SCHOOL</h2>
            <h3><?php echo $streamName ?> Examination Results for <?php echo ucfirst($term).", ".date("Y"); ?> </h3>
        </div>
        <table class="table">
            <thead>
                <tr>

                    <th scope="col">studId</th>
                    <th scope="col">Names</th>
                    <th scope="col">Chemistry</th>
                    <th scope="col">Maths</th>
                    <th scope="col">Physics</th>
                    <th scope="col">Civics</th>
                    <th scope="col">Geography</th>
                    <th scope="col">EDK</th>
                    <th scope="col">Quran</th>
                    <th scope="col">Kiswahili</th>
                    <th scope="col">English</th>
                    <th scope="col">Biology</th>
                    <th scope="col">Arabic</th>
                    <th scope="col">History</th>
                    <th scope="col">Commerce</th>
                    <th scope="col">B/keeping</th>
                    <th scope="col">Position</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                if (empty($data)) {
                   echo '<tr><td colspan="17" style="text-align: center; color: red;">Sorry, no results generated</td><tr>';
                } else {
                    foreach ($data as $studentResults) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $studentResults->studId ?></th>
                            <td><?php echo $studentResults->studNames ?></td>
                            <td><?php echo $studentResults->Chemistry ?></td>
                            <td><?php echo $studentResults->Mathematics ?></td>
                            <td><?php echo $studentResults->Physics ?></td>
                            <td><?php echo $studentResults->Civics ?></td>
                            <td><?php echo $studentResults->Geography ?></td>
                            <td><?php echo $studentResults->Islamic_knowledge ?></td>
                            <td><?php echo $studentResults->Quran ?></td>
                            <td><?php echo $studentResults->Kiswahili ?></td>
                            <td><?php echo $studentResults->English ?></td>
                            <td><?php echo $studentResults->Biology ?></td>
                            <td><?php echo $studentResults->Arabic_knowledge ?></td>
                            <td><?php echo $studentResults->History ?></td>
                            <td><?php echo $studentResults->Commerce ?></td>
                            <td><?php echo $studentResults->Book_keeping ?></td>
                            <td><?php echo $count; ?></td>

                        </tr>
                        <?php $count += 1;
                    }
                } ?>
            </tbody>
        </table>
    </body>
</html>



