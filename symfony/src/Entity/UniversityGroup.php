<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UniversityGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UniversityGroupRepository::class)
 * @ApiResource()
 */
class UniversityGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
	 *
	 * @Groups("event:nested:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
	 *
	 * @Groups("event:nested:read")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="universityGroup")
	 *
	 * @Groups("none")
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setUniversityGroup($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getUniversityGroup() === $this) {
                $event->setUniversityGroup(null);
            }
        }

        return $this;
    }
}
