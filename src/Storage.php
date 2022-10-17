<?php

namespace Manikienko\Todo;

use Manikienko\Todo\Workout;

class Storage {

    protected Filesystem $fs;
    protected string $storagePath;

    public function __construct(Filesystem $fs, string $storagePath)
    {

        $this->fs = $fs;
        $this->storagePath = $storagePath;
    }

    public function getItems()
    {
        // file_exist, file_get_contents, file_put_contents
        if (!$this->fs->exists($this->storagePath)) {
            // $arr и $string нам на самом едел тут не нужны, мы их можем убрать
            $this->fs->put($this->storagePath, json_encode([]));
        }

        // array of array
        $items = json_decode($this->fs->get($this->storagePath), true);

        // array[] -> Item[]
        $items = array_map(function(array $item) {
            return new Workout(
                $item['id'],
                $item['date'],
                $item['time'],
                $item['name'],
                $item['fullName'],
                $item['age'],
                $item['status'] ?? 'new',
                
            );
        }, $items);

        return $items;
    }

    public function saveItems(array $items): void {
        $data = array_map(function(Workout $item): array{
            return $item->toArray();
        },$items);

        $data = json_encode($data, JSON_PRETTY_PRINT);
        $this->fs->put($this->storagePath, $data);
    }
}