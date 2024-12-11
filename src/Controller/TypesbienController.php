<?php

namespace App\Controller;

use App\Entity\Typesbien;
use App\Form\TypesbienType;
use App\Repository\TypesbienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/types')]
final class TypesbienController extends AbstractController
{
    #[Route(name: 'app_typesbien_index', methods: ['GET'])]
    public function index(TypesbienRepository $typesbienRepository): Response
    {
        return $this->render('typesbien/index.html.twig', [
            'typesbiens' => $typesbienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_typesbien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typesbien = new Typesbien();
        $form = $this->createForm(TypesbienType::class, $typesbien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typesbien);
            $entityManager->flush();

            return $this->redirectToRoute('app_typesbien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('typesbien/new.html.twig', [
            'typesbien' => $typesbien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_typesbien_show', methods: ['GET'])]
    public function show(Typesbien $typesbien): Response
    {
        return $this->render('typesbien/show.html.twig', [
            'typesbien' => $typesbien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_typesbien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Typesbien $typesbien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypesbienType::class, $typesbien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_typesbien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('typesbien/edit.html.twig', [
            'typesbien' => $typesbien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_typesbien_delete', methods: ['POST'])]
    public function delete(Request $request, Typesbien $typesbien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesbien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typesbien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_typesbien_index', [], Response::HTTP_SEE_OTHER);
    }
}
