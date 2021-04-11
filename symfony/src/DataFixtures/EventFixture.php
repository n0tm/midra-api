<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Subject;
use App\Entity\Teacher;
use App\Entity\UniversityGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixture extends Fixture implements DependentFixtureInterface
{
	public const REFERENCE_CHARMS_EXAMINATION 					  = 'event.charms.examination';
	public const REFERENCE_TRANSFIGURATION_COURSE_WORK 			  = 'event.transfiguration.course.work';
	public const REFERENCE_DEFENCE_AGAINST_THE_DARK_ARTS_PRACTICE = 'event.defence.against.the.dark.arts.practice';

    public function load(ObjectManager $manager)
    {
        $charmsExamination = $this->createCharmsExamination();
        $this->addReference(self::REFERENCE_CHARMS_EXAMINATION, $charmsExamination);
        $manager->persist($charmsExamination);

        $transfigurationCourseWork = $this->createTransfigurationCourseWork();
        $this->addReference(self::REFERENCE_TRANSFIGURATION_COURSE_WORK, $transfigurationCourseWork);
        $manager->persist($transfigurationCourseWork);

        $defenceAgainstTheDarkArtsPractice = $this->createDefenceAgainstTheDarkArtsPractice();
        $this->addReference(self::REFERENCE_DEFENCE_AGAINST_THE_DARK_ARTS_PRACTICE, $defenceAgainstTheDarkArtsPractice);
        $manager->persist($defenceAgainstTheDarkArtsPractice);

        $manager->flush();
    }

    public function createCharmsExamination(): Event
	{
		$event = new Event();

		$event->setName('Examination on Charm');
		$event->setDate(new \DateTimeImmutable());

		/** @var Subject $charmsSubject */
		$charmsSubject = $this->getReference(SubjectFixture::REFERENCE_CHARMS);
		$event->setSubject($charmsSubject);
		$charmsSubject->addEvent($event);

		/** @var Teacher $teacher */
		$teacher = $this->getReference(TeacherFixture::REFERENCE_FILIUS_FLITWICK);
		$event->setTeacher($teacher);
		$teacher->addEvent($event);

		/** @var UniversityGroup $group */
		$group = $this->getReference(UniversityGroupFixture::REFERENCE_SOME);
		$event->setUniversityGroup($group);
		$group->addEvent($event);

		return $event;
	}

	private function createTransfigurationCourseWork(): Event
	{
		$event = new Event();

		$event->setName('Transfiguration Course Work');
		$event->setDate((new \DateTimeImmutable())->modify('-1 day'));

		/** @var Subject $subject */
		$subject = $this->getReference(SubjectFixture::REFERENCE_TRANSFIGURATION);
		$event->setSubject($subject);
		$subject->addEvent($event);

		/** @var Teacher $teacher */
		$teacher = $this->getReference(TeacherFixture::REFERENCE_MINERVA_MC_GONAGALL);
		$event->setTeacher($teacher);
		$teacher->addEvent($event);

		/** @var UniversityGroup $group */
		$group = $this->getReference(UniversityGroupFixture::REFERENCE_ANOTHER);
		$event->setUniversityGroup($group);
		$group->addEvent($event);

		return $event;
	}

	private function createDefenceAgainstTheDarkArtsPractice(): Event
	{
		$event = new Event();

		$event->setName('Defence Against The Dark Arts Practice');
		$event->setDate((new \DateTimeImmutable())->modify('+1 day'));

		/** @var Subject $subject */
		$subject = $this->getReference(SubjectFixture::REFERENCE_DEFENCE_AGAINST_THE_DARK_ARTS);
		$event->setSubject($subject);
		$subject->addEvent($event);

		/** @var Teacher $teacher */
		$teacher = $this->getReference(TeacherFixture::REFERENCE_SEVERUS_SNAPE);
		$event->setTeacher($teacher);
		$teacher->addEvent($event);

		/** @var UniversityGroup $group */
		$group = $this->getReference(UniversityGroupFixture::REFERENCE_SOME_ANOTHER);
		$event->setUniversityGroup($group);
		$group->addEvent($event);

		return $event;
	}

	public function getDependencies()
	{
		return [
			SubjectFixture::class,
			TeacherFixture::class,
			UniversityGroupFixture::class,
		];
	}
}
