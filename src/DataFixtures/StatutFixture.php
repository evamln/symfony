<?php

namespace App\DataFixtures;

use App\Entity\Statut;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

//Many to one (plusieurs personnages peuvent être soit allié soit enemmi)
class StatutFixture extends Fixture
{
    public const STATUT_REFERENCE = 'Statut';
    public function load(ObjectManager $manager): void
    {
        $statut = [
            'Perso Princ', 
            'Allie', 
            'Ennemi'
        ];

        foreach ($statut as $key => $allStatut) {
            $statuts = new Statut();
            $statuts->setName($allStatut);
            $manager->persist($statuts);
            $ref = self::STATUT_REFERENCE . $allStatut;
            $this->addReference($ref, $statuts);
        }
            

        $manager->flush();
    }
}
