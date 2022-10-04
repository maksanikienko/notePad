<?php

class Workout {
    public int $id;  //номер тренировки
    public string $name;  //имя клиента
    public string $fullName;   //фамилия
    public int $age; 
    public string $height; 
    public string $weight; 

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }
}
