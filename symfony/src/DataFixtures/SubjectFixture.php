<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixture extends Fixture
{
	public const REFERENCE_CHARMS    					 = 'subject.charms';
	public const REFERENCE_DEFENCE_AGAINST_THE_DARK_ARTS = 'subject.herbology';
	public const REFERENCE_TRANSFIGURATION   			 = 'subject.transfiguration';

    public function load(ObjectManager $manager)
    {
        $charms = $this->createCharms();
        $this->addReference(self::REFERENCE_CHARMS, $charms);
        $manager->persist($charms);

		$defenceAgainstTheDarkArts = $this->createDefenceAgainstTheDarkArts();
		$this->addReference(self::REFERENCE_DEFENCE_AGAINST_THE_DARK_ARTS, $defenceAgainstTheDarkArts);
		$manager->persist($defenceAgainstTheDarkArts);

		$transfiguration = $this->createTransfiguration();
		$this->addReference(self::REFERENCE_TRANSFIGURATION, $transfiguration);
		$manager->persist($transfiguration);

        $manager->flush();
    }

    private function createCharms(): Subject
	{
		$subject = new Subject();

		$subject->setName('Charms');

		return $subject;
	}

	private function createDefenceAgainstTheDarkArts(): Subject
	{
		$subject = new Subject();

		$subject->setName('Defence Against the Dark Arts');

		return $subject;
	}

	private function createTransfiguration(): Subject
	{
		$subject = new Subject();

		$subject->setName('Transfiguration');

		return $subject;
	}
}
