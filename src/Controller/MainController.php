<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageFormType;
use App\Repository\PropertiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(PropertiesRepository $propertiesRepository, Request $request, EntityManagerInterface $em): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($message);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre message. Nous vous recontacterons');
            $this->redirectToRoute('app_main');
        }
        $properties = $propertiesRepository->findBy(["sold" => false], ['created_at' => 'DESC'], 6);
        return $this->render('main/index.html.twig', compact('properties', 'form'));
    }
}