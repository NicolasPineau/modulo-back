<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ScopeRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use App\Entity\User;

#[ORM\Entity(repositoryClass: ScopeRepository::class)]
#[ApiResource]
class Scope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'])]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Structure::class, cascade: ['persist'])]
    private Structure $structure;

    #[ORM\ManyToOne(targetEntity: Role::class, cascade: ['persist'])]
    private Role $role;

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;

    }

    public function getStructure(): Structure
    {
        return $this->structure;
    }

    public function setStructure(Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }


    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}
