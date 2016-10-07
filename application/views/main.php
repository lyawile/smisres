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
        <div class="menu col-lg-12 col-md-12 col-sm-12">

        </div>
        <div class="col-lg-12 wrapper">
            <div class="col-lg-2 col-lg-offset-3 col-md-4 col-sm-12 margin-control" >
                <ul>
                    <li><a href="">Refgister students</a></li>
                    <li><a href="">Edit students</a></li>
                    <li><a href="">Transfer student</a> </li>
                </ul> 
            </div>
            <div class="col-lg-4  col-md-8 col-sm-12 margin-control">
                <?php $this->load->view($content) ?>
                <?php
//                    foreach ($records as $rec) {
//                        echo $rec->id . ' - ' . $rec->examYear . ' - ' . $rec->studId . "<br>";
//                    }
                ?> 
            </div>
        </div>
    </body>
</html>


