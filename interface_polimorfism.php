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

interface Armor {
    public function absorbDamage($damage);
}

class BronzeArmor implements Armor {
    public function absorbDamage($damage): int|float {
        return $damage / 2;
    }
}

class BrittleArmor implements Armor {
    public function absorbDamage($damage): int|float {
        return $damage  * 2;
    }
}

$bob = new Soldier('Bob');
$tedd = new Archer('Tedd');
$tedd->setArmor(new BrittleArmor());

$bob->attack($tedd);
$bob->attack($tedd);


