<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Knight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class KnightFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $knight1 = new Knight('Britney', 10, 15);
        $manager->persist($knight1);

        $knight2 = new Knight('Naruto', 12, 13);
        $manager->persist($knight2);

        $knight3 = new Knight('Pumbaa', 1, 0);
        $manager->persist($knight3);

        $manager->flush();
    }
}
