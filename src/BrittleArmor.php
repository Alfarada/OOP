<?php

namespace Alfarada;
class BrittleArmor implements Armor {
    public function absorbDamage($damage): int|float {
        return $damage  * 2;
    }
}