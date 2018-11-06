<div class="col-md-12">
    Results view
</div>
<div class="col-md-12">
    <?php
    $dir = 'results/';
    $files1 = scandir($dir);
    $fileName = $files1[2];
    ?>
    <iframe src="<?= base_url() . 'results/'.$fileName; ?>" style="width:100%; height:700px;" frameborder="0">
    </iframe>
</div>