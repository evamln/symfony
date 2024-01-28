<?php

namespace App\Controller;

use App\Enum\PersonnagesEtat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personnages;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/{_locale}/home', name: 'app_home', requirements:['_locale'=>'en|fr'])]
    public function index(EntityManagerInterface $em): Response
    {
        $personnages = $em->getRepository(Personnages::class)->findAll();
        $mort = 0;
        $vivant = 0;
        $inconnu = 0;
        foreach($personnages as $personnage){
            $etat = $personnage->getEnumType();
            if($etat == PersonnagesEtat::MORT){
                $mort++;
            }
            if($etat == PersonnagesEtat::VIVANT){
                $vivant++;
            }
            if($etat == PersonnagesEtat::INCONNU){
                $inconnu++;
            }
        }

        $lastPersonnages = $em->getRepository(Personnages::class)->findBy([], ['id' => 'DESC'], 5);
        return $this->render('home/index.html.twig', [
            'mort' => $mort,
            'vivant' => $vivant,
            'inconnu' => $inconnu,
            'personnages' => $personnages,
            'lastPersonnages' => $lastPersonnages
        ]);
    }
}
