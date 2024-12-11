<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AproposController extends AbstractController
{
    #[Route('/apropos', name: 'app_apropos')]
    public function index(): Response
    {
        return $this->render('apropos/index.html.twig', [
            'title' => 'À propos de notre application immobilière',
            'description' => 'Notre application facilite la gestion des annonces immobilières. Déposez vos biens, consultez les offres, et gérez vos propriétés en toute simplicité.',
        ]);
    }
}
