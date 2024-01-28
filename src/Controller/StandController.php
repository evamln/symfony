<?php

namespace App\Controller;

use App\Entity\Stand;
use App\Form\StandType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Personnages;

#[Route('/{_locale}/stand', name: 'app_stand', requirements:['_locale'=>'en|fr'])]
class StandController extends AbstractController
{
    #[Route('', name: '')]
    public function index(EntityManagerInterface $em): Response
    {

        $stand = $em->getRepository(Stand::class)->findAll();
        return $this->render('stand/index.html.twig', [
            'stand' => $stand,
        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
    $stand = new Stand();
    $form = $this->createForm(StandType::class, $stand);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($stand);

        $em->flush();
 
        $this->addFlash('success', 'Stand créé!');
        return $this->redirectToRoute('app_stand');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('stand/ajout_stand.html.twig', [
        'stand' => $stand,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $stand = $em->getRepository(Stand::class)->find($request->get('id'));
    $form = $this->createForm(StandType::class, $stand);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $stand = $form->getData();
        $em->persist($stand);
        $em->flush();
    }

    return $this->render('stand/modif_stand.html.twig', [
        'stand' => $stand,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $stand = $em->getRepository(Stand::class)->find($request->get('id'));
    $personnage = $em->getRepository(Personnages::class)->findOneBy(['stand' => $stand]);

    if ($personnage !== null) {
        $personnage->setStand(null);
        $em->persist($personnage);
    }
        $em->remove($stand);
        $em->flush();
        $this->addFlash('success', 'Stand supprimé!');


    return $this->redirectToRoute('app_stand');
}
}
