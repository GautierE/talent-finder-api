<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CandidateRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
#[
    ApiResource(
        operations: [
            new Post(uriTemplate: 'candidate/match'),
            new Get(uriTemplate: 'candidate/generate')
        ]
    )
]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['candidate:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['candidate:list'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['candidate:list'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['candidate:list'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['candidate:list'])]
    private ?int $experience = null;

    #[ORM\Column(length: 255)]
    #[Groups(['candidate:list'])]
    private ?string $location = null;

    #[ORM\Column]
    #[Groups(['candidate:list'])]
    private ?bool $isRemote = null;

    #[ORM\ManyToMany(targetEntity: Skill::class, inversedBy: 'candidates')]
    #[Groups(['candidate:list'])]
    private Collection $skills;

    #[ORM\Column]
    #[Groups(['candidate:list'])]
    private ?int $salary = null;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function isIsRemote(): ?bool
    {
        return $this->isRemote;
    }

    public function setIsRemote(bool $isRemote): static
    {
        $this->isRemote = $isRemote;

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): static
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): static
    {
        $this->skills->removeElement($skill);

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): static
    {
        $this->salary = $salary;

        return $this;
    }
}
