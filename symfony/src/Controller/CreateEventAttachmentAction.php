<?php

namespace App\Controller;

use App\Entity\EventAttachment;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateEventAttachmentAction extends AbstractController
{
	/**
	 * @var EventRepository
	 */
	private $eventRepository;

	public function __construct(EventRepository $eventRepository)
	{
		$this->eventRepository = $eventRepository;
	}

	public function __invoke(Request $request): EventAttachment
	{
		$uploadedFile = $request->files->get('file');

		if (!$uploadedFile) {
			throw new BadRequestHttpException('"file" is required');
		}

		if (!$request->headers->has('eventId')) {
			throw new BadRequestHttpException('"eventId" is required');
		}

		$eventId = $request->headers->get('eventId');
		$event = $this->eventRepository->find($eventId);

		if ($event === null) {
			throw new BadRequestHttpException('"eventId" not found');
		}

		$eventAttachment = new EventAttachment();
		$eventAttachment->file = $uploadedFile;
		$eventAttachment->setEvent($event);

		return $eventAttachment;
	}
}