<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>public/css/style.css"/>
    </head>
    <body style="background-color: #f7f7f7">
        <div class="container-fluid">
            <img src="<?= base_url(); ?>public/img/starter.png" style="display: block; margin:20px auto;" />
            <div class="col-md-4 col-md-offset-4 login">
                <?php
                echo form_open('user/login', array('class' => 'col-md-12'));
                ?>
                <div class="form-group">
                    <span class="error-message"></span>
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Enter Username" class="form-control"/>
                </div>
                <div class="form-group ">
                    <span class="error-message"></span>
                    <label for="username">Username</label>
                    <input type="password" name="username"  placeholder="Enter Password"class="form-control "/>
                </div>
                <input type="submit" class="btn btn-primary" value="Log in"/> 
                </form>
            </div>

        </div>

    </body>
</html>
