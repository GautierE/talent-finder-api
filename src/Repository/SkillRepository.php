<?php

namespace App\Repository;

use App\Entity\Skill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Skill>
 *
 * @method Skill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skill[]    findAll()
 * @method Skill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skill::class);
    }

    public function getRandomSkillsByCategoryAndCount(string $category, int $numSkills): array
    {
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder
            ->where('s.category = :category')
            ->setParameter('category', $category)
            ->orderBy('RAND()')
            ->setMaxResults($numSkills);

        return $queryBuilder->getQuery()->getResult();
    }
}
