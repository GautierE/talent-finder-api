<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SkillRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
#[ApiResource]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['candidate:list'])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Candidate::class, mappedBy: 'skills')]
    private Collection $candidates;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['candidate:list'])]
    private ?string $category = null;

    public function __construct()
    {
        $this->candidates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Candidate>
     */
    public function getCandidates(): Collection
    {
        return $this->candidates;
    }

    public function addCandidate(Candidate $candidate): static
    {
        if (!$this->candidates->contains($candidate)) {
            $this->candidates->add($candidate);
            $candidate->addSkill($this);
        }

        return $this;
    }

    public function removeCandidate(Candidate $candidate): static
    {
        if ($this->candidates->removeElement($candidate)) {
            $candidate->removeSkill($this);
        }

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }
}
