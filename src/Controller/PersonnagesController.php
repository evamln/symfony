<?php

namespace App\Controller;

use App\Entity\Personnages;
use App\Form\PersonnagesType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/{_locale}/personnages', name: 'app_personnages', requirements:['_locale'=>'en|fr'])]
class PersonnagesController extends AbstractController
{
    #[Route('', name: '', )]
    public function index(EntityManagerInterface $em): Response
    {
        $personnages = $em->getRepository(Personnages::class)->findAll();
        return $this->render('personnages/index.html.twig', [
            'personnages' => $personnages,

        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
    $personnages = new Personnages();

    $form = $this->createForm(PersonnagesType::class, $personnages);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($personnages);
        $em->flush();

        $this->addFlash('success', 'Personnage créé!');
        return $this->redirectToRoute('app_personnages');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('personnages/ajout_personnages.html.twig', [
        'personnages' => $personnages,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $personnages = $em->getRepository(Personnages::class)->find($request->get('id'));
    $form = $this->createForm(PersonnagesType::class, $personnages);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($personnages);
        $em->flush();
    }

    return $this->render('personnages/modif_personnages.html.twig', [
        'personnages' => $personnages,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $personnage = $em->getRepository(Personnages::class)->find($request->get('id'));
    if($personnage->getStand() != null){
        $this->addFlash('error', 'Erreur lors de la suppression du personnage, vous devez supprimer son stand en premier');
        return $this->redirectToRoute('app_personnages');
    }else{
        $em->remove($personnage);
        $em->flush();
        $this->addFlash('success', 'Personnage supprimé!');
    }

    return $this->redirectToRoute('app_personnages');
}


}
