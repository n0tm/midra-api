<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class Authenticator extends AbstractGuardAuthenticator
{
	public function start(Request $request, AuthenticationException $authException = null)
	{
		$data = [
			'message' => 'Authentication Required'
		];

		return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
	}

	public function supports(Request $request)
	{
		return $request->headers->has('X-USER-UUID');
	}

	public function getCredentials(Request $request)
	{
		return [
			'uuid' => $request->headers->get('X-USER-UUID')
		];
	}

	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		return $userProvider->loadUserByUsername($credentials['uuid']);
	}

	public function checkCredentials($credentials, UserInterface $user)
	{
		return true;
	}

	public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
	{
		$data = [
			'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
		];

		return new JsonResponse($data, Response::HTTP_FORBIDDEN);
	}

	public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
	{
		return null;
	}

	public function supportsRememberMe()
	{
		return false;
	}
}