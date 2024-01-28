<?php

namespace App\Controller;

use App\Form\PouvoirsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Pouvoirs;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/{_locale}/pouvoirs', name: 'app_pouvoirs' , requirements:['_locale'=>'en|fr'])]
class PouvoirsController extends AbstractController
{
    #[Route('', name: '')]
    public function index(EntityManagerInterface $em): Response
    {
        $pouvoirs = $em->getRepository(Pouvoirs::class)->findAll();
        return $this->render('pouvoirs/index.html.twig', [
            'pouvoirs' => $pouvoirs,
        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
    $pouvoirs = new Pouvoirs();
    $form = $this->createForm(PouvoirsType::class, $pouvoirs);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($pouvoirs);

        $em->flush();
 
        $this->addFlash('success', 'Pouvoirs créé!');
        return $this->redirectToRoute('app_pouvoirs');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('pouvoirs/ajout_pouvoirs.html.twig', [
        'pouvoirs' => $pouvoirs,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $pouvoirs = $em->getRepository(Pouvoirs::class)->find($request->get('id'));
    $form = $this->createForm(PouvoirsType::class, $pouvoirs);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $pouvoirs = $form->getData();
        $em->persist($pouvoirs);
        $em->flush();
    }

    return $this->render('pouvoirs/modif_pouvoirs.html.twig', [
        'pouvoirs' => $pouvoirs,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $personnage = $em->getRepository(Pouvoirs::class)->find($request->get('id'));
        $em->remove($personnage);
        $em->flush();
        $this->addFlash('success', 'Pouvoir supprimé!');


    return $this->redirectToRoute('app_pouvoirs');
}
}
