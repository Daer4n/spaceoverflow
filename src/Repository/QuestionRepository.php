<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

	// /**
    //  * @return Question[] Returns an array of Question objects
    //  */
    public function findByAskedOrderNewest()
    {
		return $this->addIsAskedQueryBuilder()
			->addSelect('a')
			->leftJoin('q.answers', 'a')
            ->orderBy('q.askedAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

	private function addIsAskedQueryBuilder(QueryBuilder $queryBuilder = null)
	{
		return $this->getOrCreateQueryBuilder($queryBuilder)->andWhere('q.askedAt IS NOT NULL');
	}

	private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null)
	{
		return $queryBuilder ?? $this->createQueryBuilder('q');
	}
	
    // /**
    //  * @return Question[] Returns an array of Question objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Question
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
