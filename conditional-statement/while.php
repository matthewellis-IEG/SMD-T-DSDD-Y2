<?php
$count = 10;
$flag = true;

while ($flag) {
    echo $count . "\n";
    $count--;
    if ($count < 1) {
        $flag = false;
    }
}
?>