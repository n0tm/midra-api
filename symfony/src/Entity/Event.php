<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @ApiResource()
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=UniversityGroup::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $universityGroup;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity=Subject::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subject;

    /**
     * @ORM\Column(type="datetime_immutable")
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
