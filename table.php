<?php

require "reader.php";

$f = new Reader('customers-1000.csv', 100); //Wykaz_szkół_i_placówek_wg_stanu_na_30.IX._2018_w.5.csv

$page = $_GET['page'] ?? 1;
if ($page <= 0) $page = 1;

echo "<script> const page = $page; </script>";

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
