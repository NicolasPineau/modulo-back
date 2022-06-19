<?php

namespace App\Entity;

use App\Repository\EventInvitationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventInvitationRepository::class)]
class EventInvitation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Event::class, cascade: ['persist'], inversedBy: 'eventInvitations')]
    private $event;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'eventInvitations')]
    private $recipient;

    public function __construct()
    {
        $this->recipient = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function __toString(): string
    {
        return $this->getEvent();
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRecipient(): Collection
    {
        return $this->recipient;
    }

    public function addRecipient(User $recipient): self
    {
        if (!$this->recipient->contains($recipient)) {
            $this->recipient[] = $recipient;
        }

        return $this;
    }

    public function removeRecipient(User $recipient): self
    {
        $this->recipient->removeElement($recipient);

        return $this;
    }


}
