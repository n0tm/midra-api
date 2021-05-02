<?php

namespace App\DataFixtures;

use App\Entity\UserAvatar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserAvatarFixture extends Fixture
{
	public const REFERENCE_DEFAULT_AVATAR = 'userAvatar.default.avatar';

    public function load(ObjectManager $manager)
    {
		$defaultAvatar = $this->createDefaultAvatar();
		$this->addReference(self::REFERENCE_DEFAULT_AVATAR, $defaultAvatar);
    	$manager->persist($defaultAvatar);

        $manager->flush();
    }

    private function createDefaultAvatar(): UserAvatar
	{
		$avatar = new UserAvatar();
		$avatar->setFilePath('avatar.png');
		return $avatar;
	}
}
