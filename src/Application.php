<?php

namespace Manikienko\Todo;

use Exception;
use Manikienko\Todo\Workout;

class Application  
{
    public function __construct(
        protected Storage $storage
    ) {
    }

    function addItem($id,$date,$time,$name,$fullName,$age)
    {
        $items = $this->storage->getItems();

        $newItem = new Workout($id,$date, $time,$name,$fullName,$age);
        $items[] = $newItem;

        $this->storage->saveItems($items);

        print "New items with ID '{$newItem->getId() }' was added." . PHP_EOL;
    }


    // для редактирования нам нужно знать какую запись мы ищем ($id) и что мы хотим в ней поменять ($content)
    function updateItem($id,$date,$time,$name,$fullName,$age)
    {
        $items = $this->storage->getItems();
        foreach ($items as $item) {
            if ($item->getId() === $id) {
                $item->setContent($date);
                $item->setContent($time);
                $item->setContent($name);
                $item->setContent($fullName);
                $item->setContent($age);
                print "Item with ID '$id' was updated." . PHP_EOL;
            }
        }

        $this->storage->saveItems($items);
    }

    //status
    function setItemStatus(string $id, string $newStatus)
    {
        /** @var Items[] $items */
        $items = $this->storage->getItems();

        foreach ($items as $item) {
            /** @var Items $item */
            if ($item->getId() === $id) {
                $item->setStatus($newStatus); /* @note place where exception can be thown */
                print "Item with ID '$id' was updated." . PHP_EOL;
            }
        }

        $this->storage->saveItems($items);
    }

    // удаление происходит по идентификатору ($id) записи
    function deleteItem(string $id)
    {
        /** @var Items[] $items */
        $items = $this->storage->getItems();

        foreach ($items as $key => $item) {
            /** @var Items $item */
            if ($item->getId() === $id) {
                unset($items[$key]);
                print "Item with ID '$id' was deleted." . PHP_EOL;
            }
        }

        $this->storage->saveItems($items);
    }

    function readItems()
    {
        /** @var Items[] $records */
        $records = $this->storage->getItems();

        if (empty($records)) {
            print "No records found." . PHP_EOL;
        }

        foreach ($records as $record) {
            /** @var Items $record */
            // date(<format:string>, <timestamp:int>) - это функция только форматирует даты которые передаются вторым аргументом,
            // но если ничего не передать, то это будет текущая дата
            $formattedDate = $record->getCreatedAt()->format('Y/m/d');
            print "[{$record->getId()}] <{$record->getStatus()}> {$record->getContent()} ($formattedDate)" . PHP_EOL;
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
        // @fixme extract readline() to a separate function 
        while ($command = readline("todo>")) {
            try {
                $this->executeCommand($command);
            } catch (Exception $e) { // @fixme replacewith Throwable when interfaces are available
                print "Error: {$e->getMessage()}".PHP_EOL;
            }
        }
    }

    public function executeCommand(string $command)
    {
        match ($command) {
            "add" => $this->addItem(readline("id>"),readline("date>"),readline("time>"),readline("name>"),readline("fullName>"),readline("age>")),
            "update" => $this->updateItem(readline("id>"),readline("date>"), readline("time>"),readline("name>"),readline("fullName>"),readline("age>")),
            "read" => $this->readItems(),
            "delete" => $this->deleteItem(readline("id>")),
            "set-status" => $this->setItemStatus(readline("id>"), readline("status>")),
            "help" => print $this->getHelp(), // @fixme replace print with a IO class function call
            "exit" => die("See you later" . PHP_EOL), // @fixme replace with terminate function call

            default => print "Command '$command' is not available. " .
                "Use 'php " . basename(__FILE__) . " help' command for more details" . PHP_EOL,
        };
        print PHP_EOL;
        $this->readItems();
    }
}