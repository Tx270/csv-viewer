<?php
$files = array_diff(scandir('csv'), array('.', '..'));

if(!$files) {
    echo "<script> alert('No files found in csv dir'); </script>";
    return;
}

if(isset($_GET['file'])) {
    $file = $_GET['file'];
} else {
    $file = reset($files);
    echo "<script> window.location = window.location.href.split('?')[0] + '?file=' + '$file'; </script>";
}


foreach ($files as $key => $value) {
    echo "<option value='$value' " . (($file==$value)? "selected":"") . ">" . str_replace(["-", "_", ".csv"], " ", $value) . "</option>";
}
