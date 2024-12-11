<?php

namespace App\Controller;

use App\Entity\InfoPerso;
use App\Form\InfoPersoType;
use App\Repository\InfoPersoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/infoperso')]
final class InfoPersoController extends AbstractController
{
    #[Route(name: 'app_info_perso_index', methods: ['GET'])]
    public function index(InfoPersoRepository $infoPersoRepository): Response
    {
        return $this->render('info_perso/index.html.twig', [
            'info_persos' => $infoPersoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_info_perso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infoPerso = new InfoPerso();
        $form = $this->createForm(InfoPersoType::class, $infoPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($infoPerso);
            $entityManager->flush();

            return $this->redirectToRoute('app_info_perso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('info_perso/new.html.twig', [
            'info_perso' => $infoPerso,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_info_perso_show', methods: ['GET'])]
    public function show(InfoPerso $infoPerso): Response
    {
        return $this->render('info_perso/show.html.twig', [
            'info_perso' => $infoPerso,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_info_perso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InfoPerso $infoPerso, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InfoPersoType::class, $infoPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_info_perso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('info_perso/edit.html.twig', [
            'info_perso' => $infoPerso,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_info_perso_delete', methods: ['POST'])]
    public function delete(Request $request, InfoPerso $infoPerso, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoPerso->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($infoPerso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_info_perso_index', [], Response::HTTP_SEE_OTHER);
    }
}
