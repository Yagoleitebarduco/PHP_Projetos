<?php
// echo 'URL: ' . $_GET['url'];

session_start();

require 'config.php';

spl_autoload_register(function($class){
    if(file_exists('controllers/'.$class.'.php')){
        require 'controllers/'.$class.'.php';
    } else if(file_exists('model/'.$class.'.php')){
        require 'model/'.$class.'.php';
    } else if(file_exists('core/'.$class.'.php')){
        require 'core/'.$class.'.php';
    }
});

$core = new core();
$core->run();