<?php

namespace App\DataFixtures;

use App\Entity\EventAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventAttachmentFixture extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_CHARMS_EXAMINATION_CHEAT_SHEET = 'eventAttachment.charms.examination.cheat.sheet';

    public function load(ObjectManager $manager)
    {
        $charmsExaminationCheatSheet = $this->createCharmsExaminationCheatSheet();
        $this->addReference(self::REFERENCE_CHARMS_EXAMINATION_CHEAT_SHEET, $charmsExaminationCheatSheet);
        $manager->persist($charmsExaminationCheatSheet);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EventFixture::class,
        ];
    }

    private function createCharmsExaminationCheatSheet(): EventAttachment
    {
        $eventAttachment = new EventAttachment();

        $eventAttachment->setContentUrl('event/attachment/some_cheat_sheet.txt');
        $eventAttachment->setEvent($this->getReference(EventFixture::REFERENCE_CHARMS_EXAMINATION));

        return $eventAttachment;
    }
}
