<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Poses;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PosesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/{_locale}/pose', name: 'app_pose' , requirements:['_locale'=>'en|fr'])]
class PoseController extends AbstractController
{
    #[Route('', name: '')]
    public function index(EntityManagerInterface $em): Response
    {
        $poses = $em->getRepository(Poses::class)->findAll();
        $uniqueCharacterNames = [];
        foreach ($poses as $pose) {
            $characterName = $pose->getPersonnages()->getName();
            $saisons = $pose->getSaisons();
            $saisonNames = [];
            foreach ($saisons as $saison) {
                $saisonNames[] = $saison->getName();
            }
            if (!isset($uniqueCharacterNames[$characterName])) {
                $uniqueCharacterNames[$characterName] = [];
            }
            $uniqueCharacterNames[$characterName][] = ['id' => $pose->getId(), 'pose' => $pose->getName(), 'saisons' => $saisonNames];
        }

        return $this->render('pose/index.html.twig', [
            'pose' => $poses,
            'uniqueCharacterNames' => $uniqueCharacterNames,
        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
    $pose = new Poses();
    $form = $this->createForm(PosesType::class, $pose);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($pose);
        $em->flush();
 
        $this->addFlash('success', 'Pose créé!');
        return $this->redirectToRoute('app_pose');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('pose/ajout_pose.html.twig', [
        'personnages' => $pose,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $poses = $em->getRepository(Poses::class)->find($request->get('id'));
    $form = $this->createForm(PosesType::class, $poses);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($poses);
        $em->flush();
    }

    return $this->render('pose/modif_pose.html.twig', [
        'pose' => $poses,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $pose = $em->getRepository(Poses::class)->find($request->get('id'));
        $em->remove($pose);
        $em->flush();
        $this->addFlash('success', 'Pose supprimé!');


    return $this->redirectToRoute('app_pose');
}
}
