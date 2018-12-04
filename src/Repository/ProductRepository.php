<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

     /**
      * @var string $phraseInName
      *
      * @return ArrayCollection
      */
    public function fetchByPhraseInName($phraseInName)
    {
        $phraseInName = '%' . $phraseInName . '%';
        $qb = $this->createQueryBuilder('p');

        $result = $qb
            ->where($qb->expr()->like('p.name', ':phraseInName'))
            ->setParameter('phraseInName', $phraseInName)
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($result);
    }

    /**
     * @return ArrayCollection
     */
    public function fetchAvailable()
    {
        $qb = $this->createQueryBuilder('p');

        $result = $qb
            ->where('p.available = :available')
            ->setParameter('available', true)
            ->getQuery()
            ->getResult()
        ;

        return new ArrayCollection($result);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @return int
     */
    public function getNotAvailableCount()
    {
        $qb = $this->createQueryBuilder('p');

        // no need to catch the exception
        $result = $qb
            ->select($qb->expr()->count('p'))
            ->where('p.available = :available')
            ->setParameter('available', false)
            ->getQuery()
            ->getSingleScalarResult()
        ;

        return (int) $result;
    }
}
