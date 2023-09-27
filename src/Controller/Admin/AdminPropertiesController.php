<?php

namespace App\Controller\Admin;

use App\Entity\Properties;
use App\Form\PropertiesType;
use App\Repository\PropertiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[
    Route('/admin/properties'),
    IsGranted("ROLE_ADMIN")
]
class AdminPropertiesController extends AbstractController
{
    #[Route('/', name: 'app_admin_properties_index', methods: ['GET'])]
    public function index(PropertiesRepository $propertiesRepository): Response
    {
        return $this->render('admin/admin_properties/index.html.twig', [
            'properties' => $propertiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_properties_new', methods: ['GET', 'POST'])]
    /**
     * Permet de créer un nouvel élément
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $property = new Properties();
        $form = $this->createForm(PropertiesType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($property);
            $entityManager->flush();

            $this->addFlash('success', 'Votre bien a été créer avec succès');
            return $this->redirectToRoute('app_admin_properties_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_properties/new.html.twig', [
            'property' => $property,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_admin_properties_edit', methods: ['GET', 'POST'])]
    /**
     * Pour l'édition de l'élément
     * @param Request $request
     * @param Properties $property
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function edit(Request $request, Properties $property, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PropertiesType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Votre bien a été éditer avec succès');
            return $this->redirectToRoute('app_admin_properties_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_properties/edit.html.twig', [
            'property' => $property,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_admin_properties_delete', methods: ['POST'])]
    public function delete(Request $request, Properties $property, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$property->getId(), $request->request->get('_token'))) {
            $entityManager->remove($property);
            $entityManager->flush();
        }

        $this->addFlash('success', 'La suppression a réussi');
        return $this->redirectToRoute('app_admin_properties_index', [], Response::HTTP_SEE_OTHER);
    }
}
