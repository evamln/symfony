<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pouvoirs;

class PouvoirsFixture extends Fixture
{
    public const POUVOIRS_REFERENCE = 'Pouvoirs';
    public function load(ObjectManager $manager): void
    {
        $pouvoirs = [
            'Divination',
            'Manipulation Electronique',
            'Transmission D onde',
            'Capacité Surhumaine',
            'Restauration',
            'Don de vie',
            'Injection de vie',
            'Creation d organe',
            'Senseur de vie',
            'Deroulement en fil',
            'Ongles tournoyants',
            'Trous Mouvants',
            'Trou de Ver',
            'Rotation Infinie',
            'Rotation d or',
            'Arrêt du temps',
            'Transmutation en bombe'

        ];
        foreach ($pouvoirs as $key => $allPouvoirs) {
            $pouvoirs = new Pouvoirs();
            $pouvoirs->setName($allPouvoirs);
            $manager->persist($pouvoirs);
            $ref = self::POUVOIRS_REFERENCE . $allPouvoirs;
            $this->addReference($ref, $pouvoirs);
        }
            

        $manager->flush();
    }
}
