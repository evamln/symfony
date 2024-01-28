<?php

namespace App\DataFixtures;

use App\Enum\PersonnagesEtat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Personnages;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PersonnageFixture extends Fixture implements DependentFixtureInterface
{
    public const PERSONNAGE_REFERENCE = 'Personnage';
    public function load(ObjectManager $manager): void
    {
        $personnages = [
            ['Jonathan Joestar', 'https://static.jojowiki.com/images/thumb/b/bd/latest/20221006234855/Jonathan_Infobox_Manga.png/1200px-Jonathan_Infobox_Manga.png', '', 'Perso Principal', ['Phantom Blood'], PersonnagesEtat::MORT],
            ['Joseph Joestar','https://static.jojowiki.com/images/thumb/e/e2/latest/20221006235618/Joseph_Joestar_Infobox_Manga.png/400px-Joseph_Joestar_Infobox_Manga.png', 'Hermit Purple', 'Perso Principal', ['Battle Tendancy', 'Stardust Crusaders', 'Diamond is Unbreakable'],  PersonnagesEtat::INCONNU], 
            ['Jotaro Kujo', 'https://static.jojowiki.com/images/thumb/6/69/latest/20201130220440/Jotaro_SC_Infobox_Manga.png/400px-Jotaro_SC_Infobox_Manga.png', 'Star Platinium', 'Perso Principal', ['Stardust Crusaders', 'Diamond is Unbreakable', 'Stone Ocean'],  PersonnagesEtat::VIVANT], 
            ['Josuke Higashikata', 'https://static.wikia.nocookie.net/characterprofile/images/f/f2/Josuke4.png', 'Crazy Diamond', 'Perso Principal', ['Diamond is Unbreakable'],  PersonnagesEtat::VIVANT], 
            ['Giorno Giovanna', 'https://static.jojowiki.com/images/2/21/latest/20210313222135/Giorno_Giovanna_Infobox_Manga.png', 'Gold Experience', 'Perso Principal', ['Golden Wind'],  PersonnagesEtat::VIVANT], 
            ['Jolyne Kujo', 'https://static.jojowiki.com/images/2/20/latest/20200923041552/Jolyne_Infobox_Manga.png', 'Stone Free', 'Perso Principal', ['Stone Ocean'], PersonnagesEtat::VIVANT], 
            ['Jonnhy Joestar', 'https://i.pinimg.com/originals/b9/a4/34/b9a434db7fefee96c1417e33e1f7ec88.png', 'Tusk', 'Perso Principal', ['Steel Ball Run'], PersonnagesEtat::VIVANT], 
            ['Gyro Zeppeli', 'https://static.wikia.nocookie.net/vsbattles/images/d/d1/Gyro_Zeppeli_Steel_Ball_Run.png', 'Ball Breaker', 'Allie', ['Steel Ball Run'], PersonnagesEtat::MORT], 
            ['Kars', 'https://static.wikia.nocookie.net/vsbattles/images/2/28/Karsrender.png', '', 'Ennemi', ['Battle Tendancy'], PersonnagesEtat::MORT], 
            ['Dio Brando', 'https://static.jojowiki.com/images/5/5f/latest/20210529185004/Dio_PB_Infobox_Manga.png', 'The World', 'Ennemi', ['Phantom Blood', 'Stardust Crusaders', 'Stone Ocean'], PersonnagesEtat::MORT], 
            ['Yoshikage Kira', 'https://static.jojowiki.com/images/thumb/c/ce/latest/20210107171552/Yoshikage_Kira_Original_Infobox_Manga.png/400px-Yoshikage_Kira_Original_Infobox_Manga.png', 'Killer Queen', 'Ennemi', ['Diamond is Unbreakable'], PersonnagesEtat::MORT]
           ];

           foreach ($personnages as $key => $allPerso) {
            $personnage = new Personnages();
            $personnage->setName($allPerso[0]);
            $personnage->setImage($allPerso[1]);
            if($allPerso[2] == ''){
                $personnage->setStand(null);
            }else{
                $personnage->setStand($this->getReference(StandFixture::STAND_REFERENCE . $allPerso[2]));
            }
            $personnage->setStatut($this->getReference(StatutFixture::STATUT_REFERENCE . $allPerso[3]));
            foreach($allPerso[4] as $key => $saisons){
                $personnage->addSaison($this->getReference(SaisonFixture::SAISON_REFERENCE . $saisons));
            }
            $personnage->setEnumType($allPerso[5]);
            $manager->persist($personnage);
            $ref = self::PERSONNAGE_REFERENCE . $allPerso[0];
            $this->addReference($ref, $personnage);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StandFixture::class,
            SaisonFixture::class,
            StatutFixture::class,
        ];
    }
}
