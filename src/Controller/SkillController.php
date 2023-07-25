<?php

namespace App\Controller;

use App\Entity\Skill;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SkillController extends AbstractController
{
    #[Route('/skills', name: 'get_all_skills', methods: ['GET'])]
    public function getAllSkills(EntityManagerInterface $entityManager): Response
    {
        $skills = $entityManager->getRepository(Skill::class)->findAll();

        return $this->json($skills, 200, [], ['groups' => 'skill:list']);
    }
}
