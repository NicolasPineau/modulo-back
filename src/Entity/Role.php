<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 10)]
    private string $code;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $feminineName = null;

    #[ORM\ManyToOne(targetEntity: AgeSection::class, cascade: ['persist'])]
    private AgeSection $ageSection;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $icon;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'concernedRole')]
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }


    public function getId(): ?int
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

    public function getFeminineName(): ?string
    {
        return $this->feminineName;
    }

    public function setFeminineName(?string $feminineName): self
    {
        $this->feminineName = $feminineName;

        return $this;
    }

    public function getAgeSection(): AgeSection
    {
        return $this->ageSection;
    }

    public function setAgeSection(AgeSection $ageSection): self
    {
        $this->ageSection = $ageSection;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addConcernedRole($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            $event->removeConcernedRole($this);
        }

        return $this;
    }
}
