<?php

namespace App\DataSeeds;

use App\Entity\UserAvatar;
use Evotodi\SeedBundle\Command\Seed;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserAvatarSeed extends Seed
{
	private const NAME = 'userAvatars';

	protected function configure()
	{
		$this->setSeedName(self::NAME);

		parent::configure();
	}

	public function load(InputInterface $input, OutputInterface $output)
	{
		$this->disableDoctrineLogging();

		$avatarPaths = [
			'default_avatar_1.png',
			'default_avatar_2.png',
			'default_avatar_3.png',
			'default_avatar_4.png',
			'default_avatar_5.png',
		];

		foreach ($avatarPaths as $avatarPath) {
			$userAvatar = new UserAvatar();
			$userAvatar->setFilePath($avatarPath);
			$this->manager->persist($userAvatar);
		}

		$this->manager->flush();
		$this->manager->clear();
		return 0;
	}

	/**
	 * @inheritDoc
	 */
	public function unload(InputInterface $input, OutputInterface $output)
	{
		$this->manager->getConnection()->executeStatement('DELETE FROM user_avatar');
		return 0;
	}
}