<?php

declare(strict_types=1);
ini_set('display_errors',1);
class Person
{
    public function __construct(
        protected $firstName,
        protected $lastName
    )
    {
    }

    public function fullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function firstName(): string {
        return $this->firstName;
    }

    public function setFirstName(string $name): string {
        return $this->firstName = $name;
    }
}

$person1 = new Person('Alfredo', 'Yepez');

// En PHP no tenémos una manera de indicar si una propiedad pueda ser leida mas no
// modificarla, de manera que para poder leer una propiedad como protegida o privada
// fuera del alcance de una clase podemos a travéz de un metodo.

// echo $person1->firstName; // not work
echo $person1->firstName() . '<br>'; // it's works

// tambien aplica para los metodos set

// $person1->firstName = 'Alejandro'; // not work
$person1->setFirstName('Alejandro');
echo $person1->firstName() . '<br>'; // it's works

// El propósito es permitir que el programador pueda acceder a las propiedades
// de la clase pero no modificarla o cambiarla, por lo tanto brindamos metodos
// para lectura y no brindramos metodos al programador para modificar. De
// esta manera se intenta protejer al programador de que cometa un error.