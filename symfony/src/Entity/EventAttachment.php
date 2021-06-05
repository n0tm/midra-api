<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateEventAttachmentAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ApiResource(
 *     iri="http://schema.org/MediaObject",
 *     normalizationContext={
 *         "groups"={"event_attachment:read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateEventAttachmentAction::class,
 *             "deserialize"=false,
 *     		   "defaults"={
 *     				"_api_respond"=false,
 * 				},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @Vich\Uploadable
 */
class EventAttachment
{
	/**
	 * @var int|null
	 *
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 * @ORM\Id
	 *
	 * @Groups({"event_attachment:read"})
	 */
	private $id;

	/**
	 * @var string|null
	 *
	 * @ApiProperty(iri="http://schema.org/contentUrl")
	 * @Groups({"event_attachment:read"})
	 */
	public $contentUrl;

	/**
	 * @var File|null
	 * @Assert\File(
	 *     maxSize = "2048k",
	 *     maxSizeMessage = "File exceeds allowed size",
	 *     mimeTypes = {"image/png","image/jpeg", "application/pdf"},
	 *     mimeTypesMessage = "Supported uploadeble mime types is png, jpeg, pdf"
	 * )
	 * @Assert\NotNull()
	 * @Vich\UploadableField(mapping="event_attachment", fileNameProperty="filePath")
	 */
	public $file;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(nullable=true)
	 */
	private $filePath;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="eventAttachments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

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