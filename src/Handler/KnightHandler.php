<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Handler;

use App\Domain\Arena;
use App\Entity\Knight;
use App\Repository\KnightRepositoryInterface;

class KnightHandler
{
    private KnightRepositoryInterface $knightRepository;
    private Arena $arena;

    public function __construct(KnightRepositoryInterface $knightRepository, Arena $arena)
    {
        $this->knightRepository = $knightRepository;
        $this->arena = $arena;
    }

    public function getKnight(string $id): ?Knight
    {
        return $this->knightRepository->findById($id);
    }

    public function createKnight(string $name, int $strength, int $weaponPower): Knight
    {
        $knight = new Knight($name, $strength, $weaponPower);
        $this->knightRepository->save($knight);

        return $knight;
    }

    public function listKnights(): iterable
    {
        return $this->knightRepository->getAll();
    }

    public function fight(Knight $knightA, Knight $knightB): ?Knight
    {
        return $this->arena->fight($knightA, $knightB);
    }
}
