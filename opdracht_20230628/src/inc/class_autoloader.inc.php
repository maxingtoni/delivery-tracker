<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $baseDir = "C:/xampp/htdocs/opdracht_20230628/src/class";
    $extension = ".class.php";
    $fullPath = "$baseDir/$class$extension";

    if (file_exists($fullPath)) {
        include $fullPath;
    }
});
