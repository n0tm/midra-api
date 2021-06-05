<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserAvatarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UserAvatarRepository::class)
 * @ApiResource(
 *     normalizationContext={
 *         "groups"={"user_avatar:read"}
 *     },
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @Vich\Uploadable
 */
class UserAvatar
{
	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @ORM\Id
	 *
	 * @Groups({"user_avatar:read", "user:read"})
	 */
	public $id;

	/**
	 * @var string|null
	 *
	 * @Groups("user_avatar:read", "user:read")
	 */
	public $contentUrl;

	/**
	 * @var File|null
	 *
	 * @Vich\UploadableField(mapping="user_avatar", fileNameProperty="filePath")
	 */
	public $file;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(nullable=true)
	 */
	private $filePath;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getFilePath(): ?string
	{
		return $this->filePath;
	}

	public function setFilePath(?string $filePath): self
	{
		$this->filePath = $filePath;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getContentUrl(): ?string
	{
		return $this->contentUrl;
	}

	/**
	 * @param string|null $contentUrl
	 */
	public function setContentUrl(?string $contentUrl): void
	{
		$this->contentUrl = $contentUrl;
	}

	/**
	 * @return File|null
	 */
	public function getFile(): ?File
	{
		return $this->file;
	}

	/**
	 * @param File|null $file
	 */
	public function setFile(?File $file): void
	{
		$this->file = $file;
	}
}
