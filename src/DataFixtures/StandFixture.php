<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stand;

//one to one
class StandFixture extends Fixture
{
    public const STAND_REFERENCE = 'Stand';
    public function load(ObjectManager $manager): void
    {

        $stand = [
            ['Hermit Purple', ['Divination', 'Manipulation Electronique', 'Transmission D onde'], ['Utilisation à distance']],
            ['Star Platinium', ['Capacité Surhumaine'], ['Rapide', 'Fort', 'Précis', 'Endurant', 'Bonne vision']],
            ['Crazy Diamond', ['Restauration'], ['Fort', 'Rapide', 'Précis']],
            ['Gold Experience', ['Don de vie', 'Injection de vie', 'Creation d organe', 'Senseur de vie'], ['Precis', 'Fort', 'Rapide', 'Creatif' ]],
            ['Stone Free', ['Deroulement en fil'], ['Rapide', 'Fort']],
            ['Tusk', ['Ongles tournoyants', 'Trous Mouvants', 'Trou de Ver', 'Rotation Infinie'], ['Rapide', 'Fort', 'Adaptatitf']],
            ['Ball Breaker', ['Rotation d or'], ['Rapide', 'Fort']], 
            ['The World', ['Arrêt du temps'], ['Fort', 'Rapide']],
            ['Killer Queen', ['Transmutation en bombe'], ['Fort', 'Adaptatif']]
        ];
        foreach ($stand as $key => $allStand) {
            $stands = new Stand();
            $stands->setName($allStand[0]);    
            $stands->setPouvoirs($allStand[1]);
            $stands->setPointsFort($allStand[2]);
            $manager->persist($stands);
            $ref = self::STAND_REFERENCE . $allStand[0];
            $this->addReference($ref, $stands);
        }

        $manager->flush();
    }
}
