<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;

final class ContactController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'title' => 'Home'
        ]);
    }

    #[Route('/new-contact', name: 'new_contact')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $contactDetails = new Contact();
        $form = $this->createForm(ContactType::class, $contactDetails);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $contactDetails = $form->getData();
            $manager->persist($contactDetails);
            $manager->flush();
            
            $this->addFlash('success', 'Thank you for your contact request we will get back to you soon!');
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/new.html.twig', [
            'title' => 'New Contact Request',
            'form' => $form
        ]);
    }
}
