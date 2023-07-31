<?php

namespace Alfarada;
class BronzeArmor implements Armor {
    public function absorbDamage($damage): int|float {
        return $damage / 2;
    }
}
