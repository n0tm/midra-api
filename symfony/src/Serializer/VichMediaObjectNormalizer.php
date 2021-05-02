<?php

namespace App\Serializer;

use App\Entity\EventAttachment;
use App\Entity\UserAvatar;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Vich\UploaderBundle\Storage\StorageInterface;

class VichMediaObjectNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
	use NormalizerAwareTrait;

	private const ALREADY_CALLED = 'MEDIA_OBJECT_NORMALIZER_ALREADY_CALLED';

	/**
	 * @var StorageInterface
	 */
	private $storage;

	public function __construct(StorageInterface $storage)
	{
		$this->storage = $storage;
	}

	public function normalize($object, ?string $format = null, array $context = [])
	{
		$context[self::ALREADY_CALLED] = true;

		$object->contentUrl = $this->storage->resolveUri($object, 'file');

		return $this->normalizer->normalize($object, $format, $context);
	}

	public function supportsNormalization($data, ?string $format = null, array $context = []): bool
	{
		if (isset($context[self::ALREADY_CALLED])) {
			return false;
		}

		return $data instanceof EventAttachment ||
			$data instanceof UserAvatar;
	}
}