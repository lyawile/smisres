<div class="col-md-12">
    Results view
</div>
<div class="col-md-12">
    <?php
    $dir = 'results/form_'.$classId;
    $files = scandir($dir);
    ?>
    <iframe src="<?= base_url() .$dir .'/'. $files[2]; ?>" style="width:100%; height:700px;" frameborder="0">
    </iframe>
</div>