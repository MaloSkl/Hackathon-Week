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

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $team = null;

    #[ORM\Column(length: 255)]
    private ?string $office = null;

    #[ORM\Column(length: 255)]
    private ?string $pro_photo = null;

    #[ORM\Column(length: 255)]
    private ?string $fun_photo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(string $team): static
    {
        $this->team = $team;

        return $this;
    }

    public function getOffice(): ?string
    {
        return $this->office;
    }

    public function setOffice(string $office): static
    {
        $this->office = $office;

        return $this;
    }

    public function getProPhoto(): ?string
    {
        return $this->pro_photo;
    }

    public function setProPhoto(string $pro_photo): static
    {
        $this->pro_photo = $pro_photo;

        return $this;
    }

    public function getFunPhoto(): ?string
    {
        return $this->fun_photo;
    }

    public function setFunPhoto(string $fun_photo): static
    {
        $this->fun_photo = $fun_photo;

        return $this;
    }
}
