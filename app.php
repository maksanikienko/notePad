<?php

require __DIR__."/vendor/autoload.php";
require __DIR__."/src/notepad.php";

use Manikienko\Todo\Application;
use Manikienko\Todo\Filesystem;
use Manikienko\Todo\Storage;

$app = new Application(
    new Storage(
        new Filesystem(),
        __DIR__ . 'src/data.json'
    )
);

$app->run();