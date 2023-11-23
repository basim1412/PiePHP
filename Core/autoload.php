<?php

function my_autoloader($class)
{

    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include_once $path;
    }
}

function my_autoloaderCore($class)
{
    $path = "Core/" . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include_once $path;
    }
}

function my_autoloaderSrc($class)
{
    $path = "src/" . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include_once $path;
    }
}

function my_autoloaderController($class)
{
    $path = "src/Controller" . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include_once $path;
    }
}

function my_autoloaderModel($class)
{
    $path = "src/Model" . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include_once $path;
    }
}

function my_autoloaderView($class)
{
    $path = "src/View" . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        include_once $path;
    }
}


spl_autoload_register('my_autoloader');
spl_autoload_register('my_autoloaderCore');
spl_autoload_register('my_autoloaderSrc');
spl_autoload_register('my_autoloaderController');
spl_autoload_register('my_autoloaderModel');
spl_autoload_register('my_autoloaderView');
