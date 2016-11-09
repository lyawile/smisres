<?php
$file = fopen("./files/data","r");
while(($data =fgetcsv($file)) !=false ){
print_r(fgetcsv($file));
}
fclose($file);
?>