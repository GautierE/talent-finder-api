<?php

namespace App\Service;

use App\Entity\Candidate;
use App\Data\CandidateData;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;

class CandidateService
{
    private $entityManager;
    private $skillRepository;

    private const EXPERIENCE_LEVELS = [
        ['label' => 'junior', 'min' => 0, 'max' => 3, 'salaryMin' => 25000, 'salaryMax' => 45000],
        ['label' => 'intermediate', 'min' => 4, 'max' => 6, 'salaryMin' => 40000, 'salaryMax' => 65000],
        ['label' => 'senior', 'min' => 7, 'max' => PHP_INT_MAX, 'salaryMin' => 55000, 'salaryMax' => 80000],
    ];

    public function __construct(EntityManagerInterface $entityManager, SkillRepository $skillRepository)
    {
        $this->entityManager = $entityManager;
        $this->skillRepository = $skillRepository;
    }

    public function matchCandidates(array $jobRequirements): array
    {
        $matchingCandidates = $this->entityManager
            ->getRepository(Candidate::class)
            ->findMatchingCandidates($jobRequirements);

        return $matchingCandidates;
    }

    public function sortCandidates(array $candidates, array $jobRequirements): array
    {
        $sortedCandidates = [];
        $mainSkillsLower = array_map('strtolower', $jobRequirements['mainSkills']);
        $secondarySkillsLower = array_map('strtolower', $jobRequirements['secondarySkills']);

        foreach ($candidates as $candidate) {
            $score = 0;

            $candidateSkills = $candidate->getSkills();
            foreach ($candidateSkills as $candidateSkill) {
                $skillNameLower = strtolower($candidateSkill->getName());
                if (in_array($skillNameLower, $mainSkillsLower)) {
                    $score += 10;
                } else if (in_array($skillNameLower, $secondarySkillsLower)) {
                    $score += 5;
                }
            }

            // Remove 5 points for each year of experience missing in comparison to the required experience
            $experienceDiff = $candidate->getExperience() - $jobRequirements['experience'];
            if ($experienceDiff < 0) {
                $score -= 5 * abs($experienceDiff);
            }

            $sortedCandidates[$score] = $candidate;
        }

        krsort($sortedCandidates);

        return array_values($sortedCandidates);
    }

    public function generateRandomCandidate(): Candidate
    {
        $candidate = new Candidate();
        $candidate->setFirstName('Candidate ' . rand(1000, 9999));
        $candidate->setLastName('Candidate ' . rand(1000, 9999));

        $yearsOfExperience = rand(0, 10);
        $candidate->setExperience($yearsOfExperience);

        foreach (self::EXPERIENCE_LEVELS as $experienceLevel) {
            if ($yearsOfExperience >= $experienceLevel['min'] && $yearsOfExperience <= $experienceLevel['max']) {
                // Pick a random french first and last name
                $firstName = CandidateData::getFrenchFirstNames()[rand(0, count(CandidateData::getFrenchFirstNames()) - 1)];
                $lastName = CandidateData::getFrenchLastNames()[rand(0, count(CandidateData::getFrenchLastNames()) - 1)];
                $candidate->setFirstName($firstName);
                $candidate->setLastName($lastName);
                $candidate->setEmail(strtolower($firstName . '.' . $lastName . '@gmail.com'));

                $salary = rand($experienceLevel['salaryMin'], $experienceLevel['salaryMax']);
                $candidate->setSalary($salary);

                // Pick a random city in CITIES
                $candidate->setLocation(CandidateData::getCities()[rand(0, count(CandidateData::getCities()) - 1)]);
                $candidate->setIsRemote((bool)rand(0, 1));

                // For each type of Skill, add a random number of skills to the new candidate.
                // The random number is picked between boundaries depending on the experience of the candidate
                foreach (CandidateData::getSkillCategories() as $category) {
                    $minSkills = CandidateData::getSkillCountBoundaries()[$category][$experienceLevel['label']][0];
                    $maxSkills = CandidateData::getSkillCountBoundaries()[$category][$experienceLevel['label']][1];
                    $numSkills = rand($minSkills, $maxSkills);

                    $categorySkills = $this->skillRepository->getRandomSkillsByCategoryAndCount($category, $numSkills);

                    foreach ($categorySkills as $skill) {
                        $candidate->addSkill($skill);
                    }
                }

                break;
            }
        }

        $this->entityManager->persist($candidate);
        $this->entityManager->flush();

        return $candidate;
    }
}
