<?php

namespace App\Controller;

use App\Entity\PointsFort;
use App\Form\PointsFortType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/{_locale}/points_fort', name: 'app_points_fort', requirements:['_locale'=>'en|fr'])]
class PointsFortController extends AbstractController
{
    #[Route('', name: '')]
    public function index(EntityManagerInterface $em): Response
    {
        $ptsFort = $em->getRepository(PointsFort::class)->findAll();
        return $this->render('points_fort/index.html.twig', [
            'ptsFort' => $ptsFort,
        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
    $ptsFort = new PointsFort();
    $form = $this->createForm(PointsFortType::class, $ptsFort);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($ptsFort);

        $em->flush();
 
        $this->addFlash('success', 'Points fort créé!');
        return $this->redirectToRoute('app_points_fort');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('points_fort/ajout_ptsfort.html.twig', [
        'ptsFort' => $ptsFort,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $ptsFort = $em->getRepository(PointsFort::class)->find($request->get('id'));

    $form = $this->createForm(PointsFortType::class, $ptsFort);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($ptsFort);
        $em->flush();
    }

    return $this->render('points_fort/modif_ptsfort.html.twig', [
        'ptsForts' => $ptsFort,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $personnage = $em->getRepository(PointsFort::class)->find($request->get('id'));
        $em->remove($personnage);
        $em->flush();
        $this->addFlash('success', 'Personnage supprimé!');


    return $this->redirectToRoute('app_points_fort');
}
}
