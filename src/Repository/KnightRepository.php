<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Knight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class KnightRepository extends ServiceEntityRepository implements KnightRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Knight::class);
    }

    public function findById(string $id): ?Knight
    {
        return $this->find($id);
    }

    /**
     * @return Knight[]
     */
    public function getAll(): array
    {
        return $this->findAll();
    }

    public function save(Knight $knight): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($knight);
        $entityManager->flush();
    }
}
