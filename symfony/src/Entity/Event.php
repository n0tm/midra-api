<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"event:read", "event:nested:read"}}
 * )
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
	 *
	 * @Groups("event:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
	 *
	 * @Groups("event:read")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=UniversityGroup::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
	 *
	 * @Groups("event:read")
     */
    private $universityGroup;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
	 *
	 * @Groups("event:read")
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity=Subject::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
	 *
	 * @Groups("event:read")
     */
    private $subject;

    /**
     * @ORM\Column(type="datetime_immutable")
	 *
	 * @Groups("event:read")
     */
    private $date;

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

    public function getUniversityGroup(): ?UniversityGroup
    {
        return $this->universityGroup;
    }

    public function setUniversityGroup(?UniversityGroup $universityGroup): self
    {
        $this->universityGroup = $universityGroup;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }
}
