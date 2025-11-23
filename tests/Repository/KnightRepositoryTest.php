<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Repository;

use App\Entity\Knight;
use App\Repository\KnightRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class KnightRepositoryTest extends KernelTestCase
{
    private KnightRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->repository = self::getContainer()->get(KnightRepository::class);
    }

    public function testSaveKnight(): void
    {
        $knight = new Knight('Britney', 15, 25);

        $this->repository->save($knight);

        $this->assertNotNull($knight->getId());

        $savedKnight = $this->repository->findById($knight->getId());
        $this->assertNotNull($savedKnight);
        $this->assertEquals('Britney', $savedKnight->getName());
        $this->assertEquals(15, $savedKnight->getStrength());
        $this->assertEquals(25, $savedKnight->getWeaponPower());
        $this->assertEquals(40, $savedKnight->getPower());
    }

    public function testFindById(): void
    {
        $knight = new Knight('Naruto', 20, 30);
        $this->repository->save($knight);

        $foundKnight = $this->repository->findById($knight->getId());

        $this->assertNotNull($foundKnight);
        $this->assertEquals($knight->getId(), $foundKnight->getId());
        $this->assertEquals('Naruto', $foundKnight->getName());
        $this->assertEquals(20, $foundKnight->getStrength());
        $this->assertEquals(30, $foundKnight->getWeaponPower());
        $this->assertEquals(50, $foundKnight->getPower());
    }

    public function testFindByNotFound(): void
    {
        $result = $this->repository->findById('00000000-0000-0000-0000-000000000000');

        $this->assertNull($result);
    }

    public function testGetAll(): void
    {
        $knight1 = new Knight('Britney', 25, 35);
        $knight2 = new Knight('Naruto', 18, 22);
        $knight3 = new Knight('Squeezie', 22, 28);

        $this->repository->save($knight1);
        $this->repository->save($knight2);
        $this->repository->save($knight3);

        $knights = $this->repository->getAll();

        $this->assertIsArray($knights);
        $this->assertGreaterThanOrEqual(3, count($knights));

        $knightNames = array_map(fn (Knight $k) => $k->getName(), $knights);
        $this->assertContains('Britney', $knightNames);
        $this->assertContains('Naruto', $knightNames);
        $this->assertContains('Squeezie', $knightNames);
    }
}
