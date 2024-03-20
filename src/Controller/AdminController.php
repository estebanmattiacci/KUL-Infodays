<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        $this->denyAccessUnlessGranted("IS_AUTHENTICATED");

        /** @var User $user */
        $user = $this->getUser();

        return match ($user->isVerified()) {
            true => $this->render("base_template/base.html.twig"),
            false => $this->render("admin/please_verify.html.twig"),
        };

    }
}
