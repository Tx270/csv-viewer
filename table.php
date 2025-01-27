<?php

require "reader.php";

try {
    $f = new Reader("csv/$file", 100);
} catch (Exception $exception) {
    echo "<script> alert('Can\'t open file given'); </script>";
    return;
}

$page = $_GET['page'] ?? 1;
if ($page <= 0) $page = 1;

echo "<script> const pageNumber = $page; const fileName = '$file'; </script>";

echo "<thead>";
foreach ($f->getHeader() as $key => $td) {
    echo "<td><div class='heading'> $td <input type='text' name='$key' value='" . ($_GET[$key] ?? '') . "' onchange='changed = true;'> </div></td>";
}
echo "</thead>";


foreach ($f->getPage($page) as $key => $line) {
    echo "<tr>";
    echo "<td>" . implode("</td><td>", $line) . "</td>";
    echo "</tr>";
}

if ($f->getIsLastPage()) echo "<script> document.getElementById('buttonNext').disabled = true; </script>";
