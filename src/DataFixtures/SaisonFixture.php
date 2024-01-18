<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Saisons;

//many to many
class SaisonFixture extends Fixture
{
    public const SAISON_REFERENCE = 'Saison';
    public function load(ObjectManager $manager): void
    {
       $saisons = [
        ['Phantom Blood',  'https://upload.wikimedia.org/wikipedia/en/thumb/a/aa/JoJo_Part_1_Phantom_Blood.jpg/250px-JoJo_Part_1_Phantom_Blood.jpg'],
        ['Battle Tendancy', 'https://fr.web.img6.acsta.net/pictures/20/03/10/12/09/3711933.jpg'], 
        ['Stardust Crusaders','https://upload.wikimedia.org/wikipedia/en/7/75/JoJo_Part_3_Stardust_Crusaders.jpg'],
        ['Diamond is Unbreakable','https://fr.web.img6.acsta.net/pictures/20/02/25/17/01/3137046.jpg'],
        ['Golden Wind','https://upload.wikimedia.org/wikipedia/en/6/66/JoJo_Part_5_Golden_Wind.jpg'],
        ['Stone Ocean','https://static.wikia.nocookie.net/jjba/images/0/0f/Jojo_Final_KV.jpeg/revision/latest?cb=20221024044932'],
        ['Steel Ball Run','https://www.bedetheque.com/media/Couvertures/Couv_223891.jpg'],
        ['Jojolion','https://www.manga-news.com/public/images/series/jojolion-1-delcourt.jpg'],
        ['Jojoland','https://jdworld.org/wp-content/uploads/2023/09/1200px-Volume_132.jpg'],
       ];

        foreach ($saisons as $key => $dataSaison) {
            $saison = new Saisons();
            $saison->setName($dataSaison[0]);
            $saison->setImage($dataSaison[1]);
            $manager->persist($saison);
            $ref = self::SAISON_REFERENCE . $dataSaison[0];
            $this->addReference($ref, $saison);
        }

        $manager->flush();
}
}
