<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use App\Domain\Fighter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\Table(name: 'knight')]
class Knight implements Fighter
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $strength;

    #[ORM\Column(type: 'integer')]
    private int $weaponPower;

    public function __construct(string $name, int $strength, int $weaponPower)
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->strength = $strength;
        $this->weaponPower = $weaponPower;
    }

    public function getId(): string
    {
        return $this->id->toString();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }

    public function getPower(): int
    {
        return $this->strength + $this->weaponPower;
    }
}
