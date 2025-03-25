<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormationController extends AbstractController
{
    private $nom="Melliti";
    private $prenom="Ahmed";
    private $age=20;

    #[Route('/hello', name: 'app_hello')]
    public function index1(): Response
    {
        return new Response("Bienvenue");
    }

    #[Route('/bonjour', name: 'app_bonjour')]
    public function index2(): Response
    {
        return $this->render('formation/Bonjour.html.twig');
    }

    #[Route('/affiche', name: 'app_affiche')]
    public function afficher(): Response
    {
        return $this->render('formation/affiche.html.twig',[
            'nom'=>$this->nom,
            'prenom'=>$this->prenom,
            'age'=>$this->age]);
    }

    #[Route('/user/{id}', name: 'app_user', requirements: ['id' => '\d+'])]
    public function user($id): Response
    {
        return new Response('<h1>Utilisateur ID : ' . $id . '</h1>');
    }

    #[Route('/redirectToHello', name: 'app_redirectTOHello')]
    public function redirectToHello(): Response
    {
        return $this->redirectToRoute('app_hello');
    }

    #[Route('/redirectToUser', name: 'app_redirectToUser')]
    public function redirectToUser(): Response
    {
        return $this->redirectToRoute('app_user', ['id' => 1]);
    }


}
