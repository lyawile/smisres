
<?php
//$this->load->helper('url');
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>SMIS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/style.css"/>
    </head>
    <body>
        <div class="container">
            <div class="container">
                <div class="jumbotron">
                    <?php $this->load->view($content) ?>
                    <?php
//                    foreach ($records as $rec) {
//                        echo $rec->id . ' - ' . $rec->examYear . ' - ' . $rec->studId . "<br>";
//                    }
                    ?> 
                </div>
            </div>
        </div>
    </body>
</html>


