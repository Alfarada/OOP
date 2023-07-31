<?php

namespace Alfarada;
abstract class Unit {

    protected int|float $hp = 40;
    protected int $damage = 40;
    const MINIMUN_HP = 0;
    public function __construct(
        protected string $name
    )
    { }

    public function setArmor(Armor $armor): void{
        $this->armor = $armor;
    }

    public abstract function attack(Unit $opponent): void;

    public function takeDamage(int|float $damage): void
    {
        $this->hp = $this->hp - $this->armor->absorbDamage($damage);

        if ($this->hp <= self::MINIMUN_HP) { $this->die(); }

        show("{$this->name} ahora tiene {$this->hp} puntos de vida");

    }

    protected function absorbDamage(int|float $damage): int|float
    {
        return $damage;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function die(): void
    {
        show("{$this->name} ha muerto");
        exit();
    }

}
