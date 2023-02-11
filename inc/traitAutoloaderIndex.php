<?php
spl_autoload_register('traitAutoLoader');

function traitAutoLoader($traitName)
{
    $path = "./traits/";
    $extension = ".php";
    $fullPath = $path . $traitName . $extension;
    $fullPath = str_replace('\\','/',$fullPath);

    if (!file_exists($fullPath)) {
        return false;
    }


    include_once $fullPath;
}