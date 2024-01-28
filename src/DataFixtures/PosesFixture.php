<?php

namespace App\DataFixtures;

use App\Entity\Poses;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

// One to Many un personnage peut avoir plusieures poses
class PosesFixture extends Fixture implements DependentFixtureInterface
{
    public const POSE_REFERENCE = 'Pose';
    public function load(ObjectManager $manager): void
    {
        $poses = [
            [['Adam 1880-1881', 'Studies of Teri Toye Body Conscious New York, 1963'], 'Jonathan Joestar', ['Phantom Blood']], 
            [['The Picasso of Fashion Illustration', 'California Dreamer Paris 1986'], 'Kars', ['Battle Tendancy']],
            [['TBA 1980', 'Yves Saint Laurent Haute Couture Paris, 1984'], 'Joseph Joestar', ['Battle Tendancy', 'Stardust Crusaders']],
            [['Dirty Harry', 'Vogue US January 2000',], 'Jotaro Kujo', ['Stardust Crusaders', 'Diamond is Unbreakable', 'Stone Ocean']],
            [['Gianni Versace Fall/Winter 1984', 'Gianni Versace Men Without Ties TBA 1994'], 'Josuke Higashikata', ['Diamond is Unbreakable']],
            [['Gianni Versace Spring/Summer 1997', 'Arthur Elgort s Models Manual 1990'], 'Giorno Giovanna', ['Golden Wind']],
            [['Vogue Italia Philosophy di Alberta Ferretti February 2000', 'Vogue Italia May 1998'], 'Jolyne Kujo', ['Stone Ocean']],
            [['Nina Ricci Haute Couture, 1984', 'Blade Runner June 25, 1982'], 'Dio Brando', ['Phantom Blood', 'Stardust Crusaders', 'Stone Ocean']],
            [['Gucci Fall/Winter 2009 (Advertisement)', 'Vogue Italia November 1988'], 'Jonnhy Joestar', ['Steel Ball Run']],
            [['Versace Spring/Summer 2003', 'Transworld Surf[14] June 2004'], 'Gyro Zeppeli', ['Steel Ball Run']],
            [['Gianni Versace Men s Catalog Winter 1994-1995 (Advertisement)', 'Top Model France TBA 1995'], 'Yoshikage Kira', ['Diamond is Unbreakable']],
        ];

        foreach ($poses as $key => $allPose) {   
            foreach ($allPose[0] as $key => $allPose2) {
                $pose = new Poses();   
                $pose->setName($allPose2);
                $pose->setPersonnages(($this->getReference(PersonnageFixture::PERSONNAGE_REFERENCE . $allPose[1]))); 
                foreach ($allPose[2] as $key => $allPose3) {
                    $pose->addSaison(($this->getReference(SaisonFixture::SAISON_REFERENCE . $allPose3)));
                }
                $manager->persist($pose);
            }
            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return [
            PersonnageFixture::class,
        ];
    }
}
