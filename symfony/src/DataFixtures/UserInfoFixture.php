<?php

namespace App\DataFixtures;

use App\Entity\UserInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserInfoFixture extends Fixture implements DependentFixtureInterface
{
	public const REFERENCE_HARRY_POTTER = 'userAvatar.harry.potter';

    public function load(ObjectManager $manager)
    {
    	$harryPotterUserInfo = $this->createHarryPotter();
		$this->addReference(self::REFERENCE_HARRY_POTTER, $harryPotterUserInfo);
    	$manager->persist($harryPotterUserInfo);

        $manager->flush();
    }

	public function getDependencies()
	{
		return [
			UserAvatarFixture::class,
			UserFixture::class,
			UniversityGroupFixture::class,
		];
	}

    private function createHarryPotter(): UserInfo
	{
		$userInfo = new UserInfo();

		$userInfo->setName('Harry');
		$userInfo->setSurname('Potter');

		$userInfo->setAvatar($this->getReference(UserAvatarFixture::REFERENCE_DEFAULT_AVATAR));
		$userInfo->setUser($this->getReference(UserFixture::REFERENCE_HARRY_POTTER));
		$userInfo->setUniversityGroup($this->getReference(UniversityGroupFixture::REFERENCE_SOME));

		return $userInfo;
	}
}
