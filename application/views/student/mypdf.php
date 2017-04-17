 <<<'ENDHTML'
<html>
    <body>
        <script type="text/php">
            if (isset($pdf)) {
            // open the PDF object - all drawing commands will
            // now go to the object instead of the current page
            $footer = $pdf->open_object();

            // get height and width of page
            $w = $pdf->get_width();
            $h = $pdf->get_height();

            // get font
            $font = Font_Metrics::get_font("helvetica", "normal");
            $txtHeight = Font_Metrics::get_font_height($font, 8);

            // draw a line along the bottom
            $y = $h - 2 * $txtHeight - 24;
            $color = array(0, 0, 0);
            $pdf->line(16, $y, $w - 16, $y, $color, 1);

            // set page number on the left side
            $pdf->page_text(16, $y, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, $color);
            // set additional text
            $text = "Dompdf is awesome";
            $width = Font_Metrics::get_text_width($text, $font, 8);
            $pdf->text($w - $width - 16, $y, $text, $font, 8);

            // close the object (stop capture)
            $pdf->close_object();

            // add the object to every page (can also specify
            // "odd" or "even")
            $pdf->add_object($footer, "all");
            }
        </script>
        <?php echo date("Y"); 
        ?>
    </body>
</html>
ENDHTML;