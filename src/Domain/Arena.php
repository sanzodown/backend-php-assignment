<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain;

class Arena
{
    public function fight(Fighter $fighterA, Fighter $fighterB): ?Fighter
    {
        $powerA = $fighterA->getPower();
        $powerB = $fighterB->getPower();

        if ($powerA > $powerB) {
            return $fighterA;
        }

        if ($powerB > $powerA) {
            return $fighterB;
        }

        return null;
    }
}
