<?php

declare(strict_types=1);
namespace Alfarada;
ini_set('display_errors', 1);

require 'src/helpers.php';

spl_autoload_register(function ($className) {
    if (strpos($className, 'Alfarada\\') === 0) {
        $className = str_replace('Alfarada\\','', $className);
        if (file_exists("src/$className.php")) {
            // shows the class that is trying to load
            // exit($className);
            require "src/$className.php";
        }
    }
});

$bob = new Soldier('Bob');
$tedd = new Archer('Tedd');
$tedd->setArmor(new BronzeArmor());

$bob->attack($tedd);


