<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Candidate;

class CandidateService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function matchCandidates(array $jobRequirements): array
    {
        $matchingCandidates = $this->entityManager
            ->getRepository(Candidate::class)
            ->findMatchingCandidates($jobRequirements);

        return $matchingCandidates;
    }
}
