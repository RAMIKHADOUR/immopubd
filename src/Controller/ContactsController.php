<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactsController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        MailerInterface $mailer
    ): Response {
        $contact = new Contacts();
        $form = $this->createForm(ContactsType::class, $contact);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder dans la base de données (optionnel)
            $em->persist($contact);
            $em->flush();

            // Envoyer un email
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('admin@example.com') // Remplacez par l'adresse de l'administrateur
                ->subject('Nouveau message de contact')
                ->text($contact->getMessage());
            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');
            return $this->redirectToRoute('app_contacts');
        }

        return $this->render('contacts/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
