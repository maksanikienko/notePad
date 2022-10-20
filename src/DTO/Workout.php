<?php
namespace Manikienko\Todo\DTO; // autoload by psr-4

use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;
use LogicException;
class Workout {
    public int $id;  //номер тренировки
    public $date;
    public $time;
    public string $name;  //имя клиента
    public string $fullName;   //фамилия
    public $age; 
    protected DateTimeImmutable $createdAt;
    protected $status;

    const AVAILABLE_STATUSES = ['new', 'in-progress', 'done'];

    public function __construct($id, $date,$time,$name,$fullName,$age,$status)
    {
        $this->id = $id;
        $this->date = $date;
        $this->time= $time;
        $this->name = $name;
        $this->fullName = $fullName;
        $this->age = $age;
        $this->status = $status;
        $this->createdAt = new DateTimeImmutable();
    }
    public function getId():string {
        return $this->id;
    }
    public function setContent($date,$time,$name,$fullName,$age): self
    {
        $this->date = $date;
        $this->time = $time;
        $this->name = $name;
        $this->fullName = $fullName;
        $this->age = $age;

        return $this;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $newStatus): Workout
    {
        if (!in_array($newStatus, self::AVAILABLE_STATUSES)) {
            $availableStatuses = implode(", ", self::AVAILABLE_STATUSES);
            throw new InvalidArgumentException(
                "Status '$newStatus' cannot be used. Use please one of these: $availableStatuses."
            );
        };

        $this->status = $newStatus;
        return $this;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'time' => $this->createdAt,
            'name' => $this->name,
            'fullName' => $this->fullName,
            'age' => $this->age,
            'status' => $this->status,
        ];
    }
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }


};
