<?php

declare(strict_types=1);
ini_set('display_errors', 1);

class Person
{
    public function __construct(
        protected string  $firstName,
        protected string  $lastName,
        protected ?string $nickname = 'noname',
        protected string  $birthdate = '20/12/1995'
    )
    {
    }

    public function fullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $name): string
    {
        return $this->firstName = $name;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @throws Exception
     */
    public function setNickname(string $nickname): string
    {
        if (strlen($nickname) >= 4) {
            return $this->nickname = $nickname;
        }
        throw new Exception('The nickname must have at least 2 characters!');
    }

    public function age(): int
    {
        date_default_timezone_set('UTC');
        $currentDate = new DateTime();
        $birthdate = DateTime::createFromFormat('d/m/Y', $this->birthdate);
        $age = $birthdate->diff($currentDate);
        return $age->y;
    }
}

$person1 = new Person('Alfredo', 'Yepez');

// En PHP no tenémos una manera de indicar si una propiedad puede ser leida pero que no
// permita modificarla, de manera que para poder leer una propiedad como protegida o privada
// fuera del alcance de una clase podemos a traves de un metodo.

// echo $person1->firstName; // not work
echo $person1->firstName() . '<br>'; // it's works

// tambien aplica para los metodos set

// $person1->firstName = 'Alejandro'; // not work
$person1->setFirstName('Alejandro');
echo $person1->firstName() . '<br>'; // it's works

// El propósito es permitir que el programador pueda acceder a las propiedades
// de la clase pero no modificarla o cambiarla, por lo tanto brindamos metodos
// para lectura pero no brindramos metodos para modificar. De
// esta manera se intenta proteger al programador de que cometa un error.

// get nickname
$person1->setNickname('kassadin');
echo $person1->getNickname() . '<br>';

// get birthdate
echo $person1->age() . '<br>';