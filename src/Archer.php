<?php

namespace Alfarada;
class Archer extends Unit {

    protected int $damage = 15;
    protected ?Armor $armor;
    public function __construct( string $name)
    {
        parent::__construct($name);
    }
    public function attack(Unit $opponent): void
    {
        show("{$this->name} lanza una flecha a {$opponent->getName()}");

        $opponent->takeDamage($this->damage);
    }
}
