<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[
    Route('/admin/messages', name: 'app_admin_messages_'),
    IsGranted("ROLE_ADMIN")
]
class MessageController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->render('Admin/message/index.html.twig', [
            'messages' => $messageRepository->findBy([], ['id' => 'DESC']),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Message $message, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $entityManager->remove($message);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le message a été supprimer avec succès');
        return $this->redirectToRoute('app_admin_messages_index', [], Response::HTTP_SEE_OTHER);
    }
}
