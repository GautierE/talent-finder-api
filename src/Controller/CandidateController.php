<?php

namespace App\Controller;

use App\Service\CandidateService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/candidate')]
class CandidateController extends AbstractController
{
    #[Route('/match', name: 'match_candidates', methods: ['POST'])]
    public function match(Request $request, CandidateService $candidateService): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $location = $requestData['location'] ?? null;
        $isRemote = $requestData['isRemote'] ?? null;
        $experience = $requestData['experience'] ?? null;
        $salary = $requestData['salary'] ?? null;
        $mainSkills = $requestData['mainSkills'] ?? [];
        $secondarySkills = $requestData['secondarySkills'] ?? [];

        $jobRequirements = [
            'location' => $location,
            'isRemote' => $isRemote,
            'experience' => $experience,
            'salary' => $salary,
            'mainSkills' => $mainSkills,
            'secondarySkills' => $secondarySkills
        ];

        $matchingCandidates = $candidateService->matchCandidates($jobRequirements);
        $sortedCandidates = $candidateService->sortCandidates($matchingCandidates, $jobRequirements);

        return $this->json($sortedCandidates, 200, [], ['groups' => 'candidate:list']);;
    }

    #[Route('/generate', name: 'generate_candidate', methods: ['GET'])]
    public function generate(CandidateService $candidateService): Response
    {
        $newCandidate = $candidateService->generateRandomCandidate();

        return $this->json($newCandidate, 200, [], ['groups' => 'candidate:list']);
    }
}
