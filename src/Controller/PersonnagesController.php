<?php

namespace App\Controller;

use App\Entity\Personnages;
use App\Entity\Stand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonnagesController extends AbstractController
{
    #[Route('/personnages', name: 'app_personnages')]
    public function index(EntityManagerInterface $em): Response
    {
        $personnages = $em->getRepository(Personnages::class)->findAll();
        $stand = $em->getRepository(Stand::class)->findAll();
        dd($stand);

        return $this->render('personnages/index.html.twig', [
            'personnages' => $personnages,
        ]);
    }
}
