<?php

namespace Alfarada;
class Soldier extends Unit {
    protected int $damage = 30;
    public function __construct(
        string $name,
        protected ?Armor $armor = null,
    )
    {
        parent::__construct($name);
    }

    public function attack(Unit $opponent): void
    {
        show("{$this->name} ataca con la espada a {$opponent->getName()}");

        $opponent->takeDamage($this->damage);
    }

    public function absorbDamage(int|float $damage): int|float {
        if ($this->armor) {
            $damage = $this->armor->absorbDamage($damage);
        }
        return $damage;
    }
}
