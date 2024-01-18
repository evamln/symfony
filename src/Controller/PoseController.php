<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Poses;
use Doctrine\ORM\EntityManagerInterface;

class PoseController extends AbstractController
{
    #[Route('/pose', name: 'app_pose')]
    public function index(EntityManagerInterface $em): Response
    {
        $poses = $em->getRepository(Poses::class)->findAll();

        return $this->render('pose/index.html.twig', [
            'pose' => $poses,
        ]);
    }
}
