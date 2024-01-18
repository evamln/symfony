<?php

namespace App\DataFixtures;

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
            ['Jonathan Joestar', 'https://static.wikia.nocookie.net/jjba/images/3/36/JonathanManga.png/revision/latest?cb=20201221145321&path-prefix=fr', '', 'Perso Princ', ['Phantom Blood']],
            ['Joseph Joestar','https://static.jojowiki.com/images/thumb/e/e2/latest/20221006235618/Joseph_Joestar_Infobox_Manga.png/400px-Joseph_Joestar_Infobox_Manga.png', 'Hermit Purple', 'Perso Princ', ['Battle Tendancy', 'Stardust Crusaders', 'Diamond is Unbreakable']], 
            ['Jotaro Kujo', 'https://static.jojowiki.com/images/thumb/6/69/latest/20201130220440/Jotaro_SC_Infobox_Manga.png/400px-Jotaro_SC_Infobox_Manga.png', 'Star Platinium', 'Perso Princ', ['Stardust Crusaders', 'Diamond is Unbreakable', 'Stone Ocean']], 
            ['Josuke Higashikata', 'https://static.wikia.nocookie.net/les-personnages-de-fiction/images/f/f8/Josuke_Higashikata.png/revision/latest?cb=20190214200256&path-prefix=fr', 'Crazy Diamond', 'Perso Princ', ['Diamond is Unbreakable']], 
            ['Giorno Giovanna', 'https://p7.hiclipart.com/preview/605/33/220/jojo-s-bizarre-adventure-all-star-battle-giogio-s-bizarre-adventure-jotaro-kujo-josuke-higashikata-giorno-giovanna-manga.jpg', 'Gold Experience', 'Perso Princ', ['Golden Wind']], 
            ['Jolyne Kujo', 'https://e7.pngegg.com/pngimages/545/1009/png-clipart-jotaro-kujo-josuke-higashikata-jojo-s-bizarre-adventure-all-star-battle-jolyne-cujoh-yoshikage-kira-joseph-joestar-jotaro-kujo-josuke-higashikata-thumbnail.png', 'Stone Free', 'Perso Princ', ['Stone Ocean']], 
            ['Jonnhy Joestar', 'https://i.pinimg.com/originals/b9/a4/34/b9a434db7fefee96c1417e33e1f7ec88.png', 'Tusk', 'Perso Princ', ['Steel Ball Run']], 
            ['Gyro Zeppeli', 'https://static.wikia.nocookie.net/vsbattles/images/d/d1/Gyro_Zeppeli_Steel_Ball_Run.png/revision/latest?cb=20210520203522', 'Ball Breaker', 'Allie', ['Steel Ball Run']], 
            ['Kars', 'https://static.wikia.nocookie.net/villains-fr/images/2/2b/Kars.png/revision/latest?cb=20210128160840&path-prefix=fr', '', 'Ennemi', ['Battle Tendancy']], 
            ['Dio Brando', 'https://w7.pngwing.com/pngs/37/801/png-transparent-dio-brando-jojo-s-bizarre-adventure-all-star-battle-goku-stardust-crusaders-goku-carnivoran-manga-chicken.png', 'The World', 'Ennemi', ['Phantom Blood', 'Stardust Crusaders', 'Stone Ocean']], 
            ['Yoshikage Kira', 'https://static.jojowiki.com/images/thumb/c/ce/latest/20210107171552/Yoshikage_Kira_Original_Infobox_Manga.png/400px-Yoshikage_Kira_Original_Infobox_Manga.png', 'Killer Queen', 'Ennemi', ['Diamond is Unbreakable']]
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
