<?php

namespace App\Repository;

use App\Entity\Band;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Band>
 *
 * @method Band|null find($id, $lockMode = null, $lockVersion = null)
 * @method Band|null findOneBy(array $criteria, array $orderBy = null)
 * @method Band[]    findAll()
 * @method Band[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Band::class);
    }

    public function findByNames(array $names): array
    {
        $results = $this->createQueryBuilder('b')
            ->where('b.name IN (:names)')
            ->setParameter('names', $names)
            ->getQuery()
            ->getResult();

        $bandsWithKeyAsName = [];
        foreach ($results as $result) {
            $bandsWithKeyAsName[$result->getName()] = $result;
        }

        return $bandsWithKeyAsName;
    }
}
