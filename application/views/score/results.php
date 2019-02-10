<div class="col-md-12">
    Results view
</div>
<div class="col-md-12">
    <?php
    $dir = 'results/';
    $files = scandir($dir);
    $searchedFile = 'results_for_form_' . $classId . '.pdf';
    $position = array_search("$searchedFile", $files);
    // naming classes for readability
    $classNew = array('I', 'II', 'III', 'IV');
    if ($position == FALSE) {
        $classIdentification = $classId - 1;
        echo 'No results generated for Form ' . $classNew[$classIdentification];
        exit;
    } else {
        $fileName = $files[$position];
    }
    ?>
    <iframe src="<?= base_url() . 'results/' . $fileName; ?>" style="width:100%; height:700px;" frameborder="0">
    </iframe>
</div>