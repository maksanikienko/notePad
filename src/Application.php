<?php

namespace Manikienko\Todo;

use Exception;
use Manikienko\Todo\DTO\Workout;

class Application  
{
    public function __construct(
        protected Storage $storage
    ) {
    }

    function addItem($id,$date,$time,$name,$fullName,$age,$status)
    {
        $items = $this->storage->getItems();

        $newItem = new Workout($id,$date, $time,$name,$fullName,$age,$status);
        $items[] = $newItem;

        $this->storage->saveItems($items);

        print "New items with ID '{$newItem->getId() }' was added." . PHP_EOL;
    }

    function updateItem($id,$date,$time,$name,$fullName,$age,$status)
    {
        $items = $this->storage->getItems();
        foreach ($items as $item) {
            if ($item->getId() === $id) {
                $item->setContent($date);
                $item->setContent($time);
                $item->setContent($name);
                $item->setContent($fullName);
                $item->setContent($age);
                $item->setStatus($status);
                print "Item with ID '$id' was updated." . PHP_EOL;
            }
        }

        $this->storage->saveItems($items);
    }

    function setItemStatus(string $id, string $newStatus)
    {
        $items = $this->storage->getItems();

        foreach ($items as $item) {
            if ($item->getId() === $id) {
                $item->setStatus($newStatus);
                print "Item with ID '$id' was updated." . PHP_EOL;
            }
        }

        $this->storage->saveItems($items);
    }

    function deleteItem(string $id)
    {
        $items = $this->storage->getItems();

        foreach ($items as $key => $item) {
            if ($item->getId() === $id) {
                unset($items[$key]);
                print "Item with ID '$id' was deleted." . PHP_EOL;
            }
        }

        $this->storage->saveItems($items);
    }

    function readItems()
    {
        $records = $this->storage->getItems();

        if (empty($records)) {
            print "No records found." . PHP_EOL;
        }

        foreach ($records as $record) {
            //$formattedDate = 
            $record->getCreatedAt()->format('Y/m/d');
            //print "[{$record->getId()}] <{$record->getStatus()}> ($formattedDate)" . PHP_EOL;
        }
    }

    function getHelp()
    {
        return
            "Usage:    php script.php <command> <...arguments>" . PHP_EOL .
            "Commands:" . PHP_EOL .
            "   read                       - display records from the storage"  . PHP_EOL .
            "   add         <content>      - add a records to the storage" . PHP_EOL .
            "   edit        <id> <content> - edit a records from the storage" . PHP_EOL .
            "   set-status  <id> <content> - edit a records from the storage" . PHP_EOL .
            "   delete      <id>           - delete a records from the storage" . PHP_EOL .
            "   help                       - display this message" . PHP_EOL .
            "   exit                       - to exit the application" . PHP_EOL;
    }

    public function run()
    {
        while ($command = readline("todo>")) {
            try {
                $this->executeCommand($command);
            } catch (Exception $e) { 
                print "Error: {$e->getMessage()}".PHP_EOL;
            }
        }
    }

    public function executeCommand(string $command)
    {
        match ($command) {
            "add" => $this->addItem(readline("id>"),readline("date>"),readline("time>"),readline("name>"),readline("fullName>"),readline("age>"),readline("status>")),
            "update" => $this->updateItem(readline("id>"),readline("date>"), readline("time>"),readline("name>"),readline("fullName>"),readline("age>"),readline("status>")),
            "read" => $this->readItems(),
            "delete" => $this->deleteItem(readline("id>")),
            "set-status" => $this->setItemStatus(readline("id>"), readline("status>")),
            "help" => print $this->getHelp(),
            "exit" => die("See you later" . PHP_EOL),

            default => print "Command '$command' is not available. " .
                "Use 'php " . basename(__FILE__) . " help' command for more details" . PHP_EOL,
        };
        print PHP_EOL;
        $this->readItems();
    }
}