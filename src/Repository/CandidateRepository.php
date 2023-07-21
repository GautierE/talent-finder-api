<?php

namespace App\Repository;

use App\Entity\Candidate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Candidate>
 *
 * @method Candidate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidate[]    findAll()
 * @method Candidate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidate::class);
    }

    public function findMatchingCandidates(array $jobRequirements): array
    {
        $qb = $this->createQueryBuilder('c');

        if (isset($jobRequirements['experience'])) {
            // Look for candidates with slighlty less or more experience
            $experienceRequirement = max(0, $jobRequirements['experience'] - 2);

            $qb->andWhere('c.experience >= :requiredExperience')
                ->setParameter('requiredExperience', $experienceRequirement);
        }

        if (isset($jobRequirements['isRemote']) && $jobRequirements['isRemote']) {
            $qb->andWhere('c.isRemote = :isRemote')
                ->setParameter('isRemote', true);
        } else if (isset($jobRequirements['location'])) {
            $qb->andWhere('c.location = :location')
                ->setParameter('location', $jobRequirements['location']);
        }

        if (isset($jobRequirements['salary'])) {
            $salary = $jobRequirements['salary'];
            $salaryLowerLimit = $salary  * 0.85;
            $salaryUpperLimit = $salary * 1.15;

            $qb->andWhere('c.salary BETWEEN :lowerLimit AND :upperLimit')
                ->setParameter('lowerLimit', $salaryLowerLimit)
                ->setParameter('upperLimit', $salaryUpperLimit);
        }

        return $qb->getQuery()->getResult();
    }
}
