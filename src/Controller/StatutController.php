<?php

namespace App\Controller;

use App\Entity\Statut;
use App\Form\StatutType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Personnages;

#[Route('/{_locale}/statut', name: 'app_statut', requirements:['_locale'=>'en|fr'])]
class StatutController extends AbstractController
{
    #[Route('', name: '')]
    public function index(EntityManagerInterface $em): Response
    {
        $statut = $em->getRepository(Statut::class)->findAll();
        return $this->render('statut/index.html.twig', [
            'statut' => $statut,
        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
    $statut = new Statut();
    $form = $this->createForm(StatutType::class, $statut);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($statut);

        $em->flush();
 
        $this->addFlash('success', 'Staut créé!');
        return $this->redirectToRoute('app_statut');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('statut/ajout_statut.html.twig', [
        'statut' => $statut,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $statut = $em->getRepository(Statut::class)->find($request->get('id'));
    $form = $this->createForm(StatutType::class, $statut);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $statut = $form->getData();
        $em->persist($statut);
        $em->flush();
    }

    return $this->render('statut/modif_statut.html.twig', [
        'statut' => $statut,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $statut = $em->getRepository(Statut::class)->find($request->get('id'));
    $personnages = $em->getRepository(Personnages::class)->findBy(['statut' => $statut]);

    if($personnages != null){
    foreach ($personnages as $personnages) {
        $personnages->setStatut(null);
        $em->persist($personnages);
    }
}
        $em->remove($statut);
        $em->flush();
        $this->addFlash('success', 'Statut supprimé!');


    return $this->redirectToRoute('app_statut');
}
}
