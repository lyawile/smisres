<html>
    <body>
        <?php
        if(isset($pdf)){
            echo "ff";
        }
         $w = $pdf->get_width();
         echo $w;
        ?>
        <?php echo date("Y"); ?>
    </body>
</html>
