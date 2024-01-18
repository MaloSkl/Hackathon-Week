<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstName = null;

    #[ORM\ManyToOne(targetEntity: Job::class, inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Job $Job = null;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $Team = null;

    #[ORM\ManyToOne(targetEntity: Agency::class, inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agency $Agency = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $picture_pro = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $picture_fun = null;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->Job;
    }

    public function setJob(?Job $Job): static
    {
        $this->Job = $Job;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->Team;
    }

    public function setTeam(?Team $Team): static
    {
        $this->Team = $Team;

        return $this;
    }

    public function getAgency(): ?Agency
    {
        return $this->Agency;
    }

    public function setAgency(?Agency $Agency): static
    {
        $this->Agency = $Agency;

        return $this;
    }

    public function getPicturePro(): ?string
    {
        return $this->picture_pro;
    }

    public function setPicturePro(?string $picture_pro): void
    {
        $this->picture_pro = $picture_pro;
    }

    public function getPictureFun(): ?string
    {
        return $this->picture_fun;
    }

    public function setPictureFun(?string $picture_fun): void
    {
        $this->picture_fun = $picture_fun;
    }
}
