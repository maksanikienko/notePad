<?php
require __DIR__ . '/functions.php';

$scriptPath = array_shift($argv);
$otherArgs = $argv;
while ($command = readline("todo>")) {
    match ($command) {
        "add" => add_item(readline("id>"),readline("WorkoutNumber>"),readline("Name>"),readline("Date>"),readline("Time>")),
        "update" => update_item(readline("id>"),readline("WorkoutNumber>"),readline("Name>"),readline("Date>"),readline("Time>")),
        "delete" => delete_item(readline("id>")),
        "help" => print get_help(),

        default => print "Command '$command' is not available. " .
            "Use 'php " . basename(__FILE__) . " help' command for more details" . PHP_EOL,
    };
    print PHP_EOL;
}