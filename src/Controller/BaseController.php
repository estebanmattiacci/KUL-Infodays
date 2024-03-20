<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class BaseController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if($user) {
            if (!$user->isVerified()) {
                return $this->render('admin/please_verify.html.twig');
            }
        }

        return $this->render('base_template/base.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('base_template/contact.html.twig');
    }
}