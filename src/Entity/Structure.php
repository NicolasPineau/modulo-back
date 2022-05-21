<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StructureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
#[ApiResource]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 10)]
    private string $code;

    #[ORM\ManyToOne(targetEntity: Structure::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Structure $parentStructure;

    public function __construct()
    {
        $this->parentStructure = null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getParentStructure(): ?Structure
    {
        return $this->parentStructure;
    }

    public function setParentStructure(?Structure $parentStructure): self
    {
        $this->parentStructure = $parentStructure;

        return $this;
    }
}
