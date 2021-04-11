<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeacherFixture extends Fixture
{
	public const REFERENCE_FILIUS_FLITWICK     = 'teacher.filius.flitwick';
	public const REFERENCE_SEVERUS_SNAPE       = 'teacher.severus.snape';
	public const REFERENCE_MINERVA_MC_GONAGALL = 'teacher.minerva.mc.gonagall';

    public function load(ObjectManager $manager)
    {
		$filiusFlitwick = $this->createFiliusFlitwick();
        $this->addReference(self::REFERENCE_FILIUS_FLITWICK, $filiusFlitwick);
        $manager->persist($filiusFlitwick);

		$severusSnape = $this->createSeverusSnape();
		$this->addReference(self::REFERENCE_SEVERUS_SNAPE, $severusSnape);
		$manager->persist($severusSnape);

		$minervaMcGonagall = $this->createMinervaMcGonagall();
		$this->addReference(self::REFERENCE_MINERVA_MC_GONAGALL, $minervaMcGonagall);
		$manager->persist($minervaMcGonagall);

        $manager->flush();
    }

    private function createFiliusFlitwick(): Teacher
	{
		$teacher = new Teacher();

		$teacher->setName('Filius Flitwick');

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
