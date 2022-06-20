<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue('CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[ORM\Column(type: 'uuid', length: 96, unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 10)]
    private string $code;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $feminineName;

    #[ORM\ManyToOne(targetEntity: AgeSection::class, cascade: ['persist'])]
    private AgeSection $ageSection;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $icon;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'concernedRole')]
    private $events;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: Credential::class)]
    private $credentials;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: TypeEventAuthorization::class)]
    private $typeEventAuthorizations;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->credentials = new ArrayCollection();
        $this->typeEventAuthorizations = new ArrayCollection();
        $this->feminineName = null;
    }

    public function getId(): Uuid
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

    /**
     * @return Collection<int, Credential>
     */
    public function getCredentials(): Collection
    {
        return $this->credentials;
    }

    public function addCredential(Credential $credential): self
    {
        if (!$this->credentials->contains($credential)) {
            $this->credentials[] = $credential;
            $credential->setRole($this);
        }

        return $this;
    }

    public function removeCredential(Credential $credential): self
    {
        if ($this->credentials->removeElement($credential)) {
            // set the owning side to null (unless already changed)
            if ($credential->getRole() === $this) {
                $credential->setRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeEventAuthorization>
     */
    public function getTypeEventAuthorizations(): Collection
    {
        return $this->typeEventAuthorizations;
    }

    public function addTypeEventAuthorization(TypeEventAuthorization $typeEventAuthorization): self
    {
        if (!$this->typeEventAuthorizations->contains($typeEventAuthorization)) {
            $this->typeEventAuthorizations[] = $typeEventAuthorization;
            $typeEventAuthorization->setRole($this);
        }

        return $this;
    }

    public function removeTypeEventAuthorization(TypeEventAuthorization $typeEventAuthorization): self
    {
        if ($this->typeEventAuthorizations->removeElement($typeEventAuthorization)) {
            // set the owning side to null (unless already changed)
            if ($typeEventAuthorization->getRole() === $this) {
                $typeEventAuthorization->setRole(null);
            }
        }

        return $this;
    }


}
