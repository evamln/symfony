<?php

namespace App\Controller;

use App\Entity\Saisons;
use App\Form\SaisonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/{_locale}/saison', name: 'app_saison', requirements:['_locale'=>'en|fr'])]
class SaisonController extends AbstractController
{
    #[Route('', name: '')]
    public function index(EntityManagerInterface $em): Response
    {
        $saisons = $em->getRepository(Saisons::class)->findAll();
        return $this->render('saison/index.html.twig', [
            'saisons' => $saisons,
        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
    $saison = new Saisons();
    $form = $this->createForm(SaisonType::class, $saison);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($saison);

        $em->flush();
 
        $this->addFlash('success', 'Saison créé!');
        return $this->redirectToRoute('app_saison');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('saison/ajout_saison.html.twig', [
        'stand' => $saison,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $saison = $em->getRepository(Saisons::class)->find($request->get('id'));
    $form = $this->createForm(SaisonType::class, $saison);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $saison = $form->getData();
        $em->persist($saison);
        $em->flush();
    }

    return $this->render('saison/modif_saison.html.twig', [
        'saison' => $saison,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $saison = $em->getRepository(Saisons::class)->find($request->get('id'));
        $em->remove($saison);
        $em->flush();
        $this->addFlash('success', 'Saison supprimé!');


    return $this->redirectToRoute('app_saison');
}
}
