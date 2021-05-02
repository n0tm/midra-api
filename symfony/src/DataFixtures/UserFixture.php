<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
	public const REFERENCE_HARRY_POTTER = 'user.harry.potter';

    public function load(ObjectManager $manager)
    {
    	$harryPotter = new User();
		$this->addReference(self::REFERENCE_HARRY_POTTER, $harryPotter);
		$manager->persist($harryPotter);

        $manager->flush();
    }
}
