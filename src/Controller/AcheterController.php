<?php

namespace App\Controller;

use App\Form\RechercheType;
use App\Repository\AnnoncesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcheterController extends AbstractController
{
    #[Route('/acheter', name: 'app_acheter')]
    public function index(Request $request, AnnoncesRepository $annoncesRepository): Response
    {

        // Créez le formulaire de recherche
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);

        // Initialisez les résultats
        $annonces = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = $form->getData();

            // Rechercher les annonces en fonction des critères
            $annonces = $annoncesRepository->findBySearchCriteria($criteria);
        }

        return $this->render('home/home.html.twig', [
            'form' => $form->createView(),
            'annonces' => $annonces,
        ]);
    
    }
}
