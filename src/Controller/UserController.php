<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/{_locale}/user', name: 'app_user', requirements:['_locale'=>'en|fr'])]
class UserController extends AbstractController
{
    #[Route('', name: '')]
    public function index(EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/creation', name: '_creation', methods: ['GET', 'POST'])]
    public function creation(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher): Response
    {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            )
        );
        $em->persist($user);

        $em->flush();
 
        $this->addFlash('success', 'User créé!');
        return $this->redirectToRoute('app_user');
    }else{
        $this->addFlash('error', 'Erreur lors de la création du stand');
    }
 
    return $this->render('user/user_statut.html.twig', [
        'user' => $user,
        'form' => $form->createView()
    ]);
}

#[Route('/{id}', name: '_detail', requirements: ['id' => '\d+'])]
public function detail(Request $request, EntityManagerInterface $em): Response
{   

    $user = $em->getRepository(User::class)->find($request->get('id'));
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $user = $form->getData();
        $em->persist($user);
        $em->flush();
    }

    return $this->render('user/modif_user.html.twig', [
        'user' => $user,
        'form' => $form->createView()
    ]);
}

#[Route('{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
public function supprimer(Request $request, EntityManagerInterface $em): RedirectResponse
{
    $personnage = $em->getRepository(User::class)->find($request->get('id'));
        $em->remove($personnage);
        $em->flush();
        $this->addFlash('success', 'User supprimé!');


    return $this->redirectToRoute('app_user');
}
}
