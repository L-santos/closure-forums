<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Thread;

/**
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findLastByThread($thread)
    {
        return $this->createQueryBuilder('p')
            ->where('p.thread = :thread')->setParameter('thread', $thread)
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }

    public function findLastByForum($forum){
        return $this->createQueryBuilder('p')
            ->innerJoin(Thread::class, 't', 'WITH', 'p.thread = t')
            ->where('t.forum = :value')->setParameter('value', $forum)
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }
}
