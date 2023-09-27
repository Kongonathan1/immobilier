<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Properties;
use App\Entity\PropertySearch;
use App\Form\MessageFormType;
use App\Form\PropertySearchFormType;
use App\Repository\PropertiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/property', name: 'app_property_')]
class PropertyController extends AbstractController
{

    public function __construct(private PropertiesRepository $propertiesRepository)
    {}

    #[Route('/', name: 'index')]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $search = new PropertySearch();
        $searchForm = $this->createForm(PropertySearchFormType::class, $search);

       $pagination = $paginator
       ->paginate(
            $this->propertiesRepository->findAllResult($request),
            $request->query->get('page', 1),
            8
        );

        return $this->render('property/index.html.twig', compact('pagination', 'searchForm'));
    }

    #[Route('/{id}', name: 'show')]
    public function show(Properties $property, Request $request, EntityManagerInterface $em): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $message->setProperty($property);
            $em->persist($message);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre message. Nous vous recontacterons');
        }
        return $this->render('property/show.html.twig', [                    
            'property' => $property,
            'form' => $form
        ]);
    }
}
