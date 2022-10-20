<?php

require __DIR__."/vendor/autoload.php";

use Manikienko\Todo\Application;
use Manikienko\Todo\Filesystem;
use Manikienko\Todo\Storage;

$app = new Application(
    new Storage(
        new Filesystem(),
        __DIR__ . '/resources/data.json'
    )
);

$app->run();