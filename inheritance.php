<?php

declare(strict_types = 1);
ini_set('display_errors', 1);

abstract class Unit {

    protected bool $alive = true;
    public function __construct(
        protected string $name
    )
    { }

    public function move(string $direction): void
    {
        echo "<p>{$this->name} avanza hacia $direction</p>";
    }

    public abstract function attack($opponent): void;
}

class Soldier extends Unit {
    public function attack($opponent): void
    {
        echo "<p>{$this->name} ataca con la espada a $opponent</p>";
    }
}

class Archer extends Unit {
    public function attack($opponent): void
    {
        echo "<p>{$this->name} lanza una flecha a $opponent</p>";
    }
}

$alfredo = new Soldier('Alfredo');
//$alfredo->move('hacia el norte');
$alfredo->attack('Ramm');

$saylon = new Archer('Saylon');
$saylon->attack('Ramm');