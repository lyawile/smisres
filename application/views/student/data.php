<?php
//print_r($mpunga);
$filename = $mpunga['file_name'];
$filepath = $mpunga['file_path'];
$fullpath = $filepath.$filename;
?>
<a href="http://localhost/smis/files/<?php echo $filename ?>">open a file</a>
