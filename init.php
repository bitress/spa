<?php
require_once 'config/Configuration.php';

spl_autoload_register(function ($class){

    $file =  __DIR__ . '/Engine/'. $class .'.php';

    if (file_exists($file)){
        include_once $file;
    }

});
