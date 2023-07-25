<?php

declare(strict_types = 1);
ini_set('display_errors', 1);

function show(string $message): void
{
    echo "<p>{$message}</p>";
}

abstract class Unit {

    protected int|float $hp = 40;
    protected int $damage = 40;
    const MINIMUN_HP = 0;
    public function __construct(
        protected string $name
    )
    { }

    public abstract function attack(Unit $opponent): void;

    public function takeDamage(int|float $damage)
    {
        $this->setHp($this->hp - $damage);

        if ($this->hp <= self::MINIMUN_HP) { $this->die(); }
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setHp(int|float $hp): void
    {
        $this->hp = $hp;
        // terminate script execution if life has reached zero
        if ($this->hp <= self::MINIMUN_HP) { exit($this->die()); }

        show("{$this->name} ahora tiene {$this->hp} puntos de vida");
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function die(): void
    {
        show("{$this->name} ha muerto");
    }
}

class Soldier extends Unit {

    protected int $damage = 30;
    public function attack(Unit $opponent): void
    {
        show("{$this->name} ataca con la espada a {$opponent->getName()}");

        $opponent->takeDamage($this->damage);
    }

    public function takeDamage(int|float $damage): void
    {
        parent::takeDamage($damage / 2);
    }
}

class Archer extends Unit {

    protected int $damage = 15;
    public function attack(Unit $opponent): void
    {
        show("{$this->name} lanza una flecha a {$opponent->getName()}");

        $opponent->takeDamage($this->damage);
    }

    public function takeDamage(int|float $damage): void
    {
        parent::takeDamage($damage / 4);
    }
}

$bob = new Soldier('Bob');
$tedd = new Archer('Tedd');

$bob->attack($tedd);
$bob->attack($tedd);

