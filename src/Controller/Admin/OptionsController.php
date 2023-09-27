<?php

namespace App\Controller\Admin;

use App\Entity\Options;
use App\Form\OptionsType;
use App\Repository\OptionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[
    Route('/admin/options', name: 'app_admin_options_'),
    IsGranted("ROLE_ADMIN")
]
class OptionsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(OptionsRepository $optionsRepository): Response
    {
        return $this->render('admin/options/index.html.twig', [
            'options' => $optionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $option = new Options();
        $form = $this->createForm(OptionsType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($option);
            $entityManager->flush();
            $this->addFlash('success', 'Votre option a bien été ajouter');
            return $this->redirectToRoute('app_admin_options_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/options/new.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Options $option, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OptionsType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre option a bien été modifier');
            return $this->redirectToRoute('app_admin_options_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/options/edit.html.twig', [
            'option' => $option,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Options $option, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$option->getId(), $request->request->get('_token'))) {
            $entityManager->remove($option);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Votre option a bien été supprimer');
        return $this->redirectToRoute('app_admin_options_index', [], Response::HTTP_SEE_OTHER);
    }
}
