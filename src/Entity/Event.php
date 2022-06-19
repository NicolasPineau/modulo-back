<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $dateStart;

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $dateEnd;

    #[ORM\Column(type: 'text')]
    private ?string $description;

    #[ORM\ManyToOne(targetEntity: TypeEvent::class, inversedBy: 'events')]
    private ?TypeEvent $typeEvent;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isActive;

    #[ORM\ManyToMany(targetEntity: Structure::class, inversedBy: 'events')]
    private $concernedStructure;

    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'events')]
    private $concernedRole;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'events')]
    private $concernedUser;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventInvitation::class)]
    private $eventInvitations;

    public function __construct()
    {
        $this->concernedStructure = new ArrayCollection();
        $this->concernedRole = new ArrayCollection();
        $this->concernedUser = new ArrayCollection();
        $this->eventInvitations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getDateStart(): ?DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeEvent(): ?TypeEvent
    {
        return $this->typeEvent;
    }

    public function setTypeEvent(?TypeEvent $typeEvent): self
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getConcernedStructure(): Collection
    {
        return $this->concernedStructure;
    }

    public function addConcernedStructure(Structure $concernedStructure): self
    {
        if (!$this->concernedStructure->contains($concernedStructure)) {
            $this->concernedStructure[] = $concernedStructure;
        }

        return $this;
    }

    public function removeConcernedStructure(Structure $concernedStructure): self
    {
        $this->concernedStructure->removeElement($concernedStructure);

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getConcernedRole(): Collection
    {
        return $this->concernedRole;
    }

    public function addConcernedRole(Role $concernedRole): self
    {
        if (!$this->concernedRole->contains($concernedRole)) {
            $this->concernedRole[] = $concernedRole;
        }

        return $this;
    }

    public function removeConcernedRole(Role $concernedRole): self
    {
        $this->concernedRole->removeElement($concernedRole);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getConcernedUser(): Collection
    {
        return $this->concernedUser;
    }

    public function addConcernedUser(User $concernedUser): self
    {
        if (!$this->concernedUser->contains($concernedUser)) {
            $this->concernedUser[] = $concernedUser;
        }

        return $this;
    }

    public function removeConcernedUser(User $concernedUser): self
    {
        $this->concernedUser->removeElement($concernedUser);

        return $this;
    }

    /**
     * @return Collection<int, EventInvitation>
     */
    public function getEventInvitations(): Collection
    {
        return $this->eventInvitations;
    }

    public function addEventInvitation(EventInvitation $eventInvitation): self
    {
        if (!$this->eventInvitations->contains($eventInvitation)) {
            $this->eventInvitations[] = $eventInvitation;
            $eventInvitation->setEvent($this);
        }

        return $this;
    }

    public function removeEventInvitation(EventInvitation $eventInvitation): self
    {
        if ($this->eventInvitations->removeElement($eventInvitation)) {
            // set the owning side to null (unless already changed)
            if ($eventInvitation->getEvent() === $this) {
                $eventInvitation->setEvent(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

}
