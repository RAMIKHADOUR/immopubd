<?php

namespace App\Controller;

use App\Entity\Categorysbien;
use App\Form\CategorysbienType;
use App\Repository\CategorysbienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/categorys')]
final class CategorysbienController extends AbstractController
{
    #[Route(name: 'app_categorysbien_index', methods: ['GET'])]
    public function index(CategorysbienRepository $categorysbienRepository): Response
    {
        return $this->render('categorysbien/index.html.twig', [
            'categorysbiens' => $categorysbienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorysbien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorysbien = new Categorysbien();
        $form = $this->createForm(CategorysbienType::class, $categorysbien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorysbien);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorysbien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorysbien/new.html.twig', [
            'categorysbien' => $categorysbien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorysbien_show', methods: ['GET'])]
    public function show(Categorysbien $categorysbien): Response
    {
        return $this->render('categorysbien/show.html.twig', [
            'categorysbien' => $categorysbien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorysbien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorysbien $categorysbien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorysbienType::class, $categorysbien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorysbien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorysbien/edit.html.twig', [
            'categorysbien' => $categorysbien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorysbien_delete', methods: ['POST'])]
    public function delete(Request $request, Categorysbien $categorysbien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorysbien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($categorysbien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorysbien_index', [], Response::HTTP_SEE_OTHER);
    }
}
