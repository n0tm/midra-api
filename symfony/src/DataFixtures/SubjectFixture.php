<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixture extends Fixture
{
	private const REFERENCE_CHARMS    = 'subject.charms';
	private const REFERENCE_HERBOLOGY = 'subject.herbology';
	private const REFERENCE_POTIONS   = 'subject.potions';

    public function load(ObjectManager $manager)
    {
        $charms = $this->createCharms();
        $this->addReference(self::REFERENCE_CHARMS, $charms);
        $manager->persist($charms);

		$herbology = $this->createHerbology();
		$this->addReference(self::REFERENCE_HERBOLOGY, $herbology);
		$manager->persist($herbology);

		$potions = $this->createPotions();
		$this->addReference(self::REFERENCE_POTIONS, $potions);
		$manager->persist($potions);

        $manager->flush();
    }

    private function createCharms(): Subject
	{
		$subject = new Subject();

		$subject->setName('Charms');

		return $subject;
	}

	private function createHerbology(): Subject
	{
		$subject = new Subject();

		$subject->setName('Herbology');

		return $subject;
	}

	private function createPotions(): Subject
	{
		$subject = new Subject();

		$subject->setName('Potions');

		return $subject;
	}
}
