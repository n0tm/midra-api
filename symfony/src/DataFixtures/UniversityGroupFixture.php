<?php

namespace App\DataFixtures;

use App\Entity\UniversityGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UniversityGroupFixture extends Fixture
{
	private const REFERENCE_SOME 		 = 'groups.some';
	private const REFERENCE_ANOTHER 	 = 'groups.another';
	private const REFERENCE_SOME_ANOTHER = 'groups.some.another';

    public function load(ObjectManager $manager)
    {
        $some = $this->createSomeGroup();
        $this->addReference(self::REFERENCE_SOME, $some);
        $manager->persist($some);

		$another = $this->createAnotherGroup();
		$this->addReference(self::REFERENCE_ANOTHER, $another);
		$manager->persist($another);

		$someAnother = $this->createSomeAnotherGroup();
		$this->addReference(self::REFERENCE_SOME_ANOTHER, $someAnother);
		$manager->persist($someAnother);

        $manager->flush();
    }

    private function createSomeGroup(): UniversityGroup
	{
		$group = new UniversityGroup();

		$group->setName('ABCD-12-34');

		return $group;
	}

	private function createAnotherGroup(): UniversityGroup
	{
		$group = new UniversityGroup();

		$group->setName('EFGH-56-78');

		return $group;
	}

	private function createSomeAnotherGroup(): UniversityGroup
	{
		$group = new UniversityGroup();

		$group->setName('IJKL-90-12');

		return $group;
	}
}
