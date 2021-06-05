<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserInfoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserInfoRepository::class)
 * @ApiResource()
 */
class UserInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Groups("user:write", "user:read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Groups("user:write", "user:read")
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userInfo", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=UserAvatar::class)
     * @ORM\JoinColumn(nullable=false)
	 * @Groups("user:write", "user:read")
     */
    private $avatar;

    /**
     * @ORM\ManyToOne(targetEntity=UniversityGroup::class, inversedBy="userInfos")
     * @ORM\JoinColumn(nullable=false)
	 * @Groups("user:write", "user:read")
     */
    private $universityGroup;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAvatar(): ?UserAvatar
    {
        return $this->avatar;
    }

    public function setAvatar(?UserAvatar $avatar): self
    {
        $this->avatar = $avatar;

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
}
