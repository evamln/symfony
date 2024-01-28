<?php

namespace App\DataFixtures;

use App\Entity\PointsFort;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PointsFortFixture extends Fixture
{
    public const POINTSFORT_REFERENCE = 'PointsFort';
    public function load(ObjectManager $manager): void
    {
        $pointsFort = [
            'Utilisation à distance',
            'Rapide',
            'Fort',
            'Precis',
            'Endurant',
            'Bonne vision',
            'Creatif',
            'Adaptatif'
            
        ];
        foreach ($pointsFort as $key => $allPointsFort) {
            $pointsFort = new PointsFort();
            $pointsFort->setName($allPointsFort);
            $manager->persist($pointsFort);
            $ref = self::POINTSFORT_REFERENCE . $allPointsFort;
            $this->addReference($ref, $pointsFort);
        }
            

        $manager->flush();
    }
}
