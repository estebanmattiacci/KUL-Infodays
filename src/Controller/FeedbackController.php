<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\Interest;
use App\Entity\User;
use App\Form\FeedbackType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    ***REMOVED***[Route('/feedback', name: 'app_feedback')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED");

        /** @var User $user */
        $user = $this->getUser();
        if($user) {
            if (!$user->isVerified()) {
                return $this->render('admin/please_verify.html.twig');
            }
        }

        if($user->getFeedback() != null){
            $this->addFlash('app_feedback', 'You have already submitted feedback, you have been redirected.');
            return $this->redirectToRoute('app_feedbacks');
        }

        $feedback = new Feedback();

        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user->setFeedback($feedback);
            $feedback->setUser($user);

            foreach($feedback->getInterests() as $interest){
                $interest->addFeedback($feedback);
                $entityManager->persist($interest);
            }
            $entityManager->persist($feedback);
            $entityManager->flush();
            $this->addFlash('success', 'Feedback submitted successfully.');
            return $this->redirectToRoute('app_feedbacks');
        }
        return $this->render('feedback/index.html.twig', [
            'feedbackForm' => $form->createView(),
        ]);
    }
}