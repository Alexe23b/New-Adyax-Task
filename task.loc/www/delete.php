<?php

$dir=file_get_contents('dir.txt');
//print_r($_GET);
foreach($_GET as $k){
    unlink($dir.'/'.$k);
}
Header ("Location: index.php?filename=$filename")
?>