<?php

namespace App\Repository;

use App\Entity\Forum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class ForumRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Forum::class);
    }

    /**
     * Find forums without parents
     */
    public function findOrphans(){
        return $this->createQueryBuilder('f')
            ->where('f.parent is null')
            ->getQuery()
            ->getResult()
        ;
    }

    public function forumCount()
    {
        return $this->createQueryBuilder('f')
        ->select('count(f)')
        ->getQuery()
        ->getSingleScalarResult(); //getResult returns an array
    }

    public function findLastThreadActive(){

    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
