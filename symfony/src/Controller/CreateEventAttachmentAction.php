<?php

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\EventAttachment;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

	/**
	 * @param Request $request
	 * @param ValidatorInterface $validator
	 * @return JsonResponse
	 */
	public function __invoke(Request $request, ValidatorInterface $validator)
	{
		$uploadedFiles = $request->files->get('file');
		if (!is_array($uploadedFiles)) {
			$uploadedFiles = [$uploadedFiles];
		}

		if (!$uploadedFiles) {
			throw new BadRequestHttpException('"file" is required');
		}

		if (!$request->headers->has('eventId')) {
			throw new BadRequestHttpException('"eventId" is required');
		}

		$eventId = $request->headers->get('eventId');
		$event = $this->eventRepository->find($eventId);

		if ($event === null) {
			throw new NotFoundHttpException('event not found');
		}

		foreach ($uploadedFiles as $uploadedFile) {
			$eventAttachment = new EventAttachment();
			$eventAttachment->file = $uploadedFile;
			$eventAttachment->setEvent($event);

			$validator->validate($eventAttachment);
			$this->getDoctrine()->getManager()->persist($eventAttachment);
		}

		$this->getDoctrine()->getManager()->flush();
		return new JsonResponse(['success' => true]);
	}
}