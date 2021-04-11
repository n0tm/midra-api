<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeacherFixture extends Fixture
{
	public const REFERENCE_ALBUS_DUMBLEDORE    = 'teacher.albus.dumbledore';
	public const REFERENCE_SEVERUS_SNAPE       = 'teacher.severus.snape';
	public const REFERENCE_MINERVA_MC_GONAGALL = 'teacher.minerva.mc.gonagall';

    public function load(ObjectManager $manager)
    {
        $albus = $this->createAlbusDumbledore();
        $this->addReference(self::REFERENCE_ALBUS_DUMBLEDORE, $albus);
        $manager->persist($albus);

		$severusSnape = $this->createSeverusSnape();
		$this->addReference(self::REFERENCE_SEVERUS_SNAPE, $severusSnape);
		$manager->persist($severusSnape);

		$minervaMcGonagall = $this->createMinervaMcGonagall();
		$this->addReference(self::REFERENCE_MINERVA_MC_GONAGALL, $minervaMcGonagall);
		$manager->persist($minervaMcGonagall);

        $manager->flush();
    }

    private function createAlbusDumbledore(): Teacher
	{
		$teacher = new Teacher();

		$teacher->setName('Albus Dumbledore');

		return $teacher;
	}

	private function createSeverusSnape(): Teacher
	{
		$teacher = new Teacher();

		$teacher->setName('Severus Snape');

		return $teacher;
	}

	private function createMinervaMcGonagall(): Teacher
	{
		$teacher = new Teacher();

		$teacher->setName('Minerva McGonagall');

		return $teacher;
	}
}
