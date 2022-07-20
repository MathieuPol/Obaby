<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PracticeController extends AbstractController
{
    /**
     * @Route("/front/practice", name="app_front_practice")
     */
    public function index(): Response
    {
        return $this->render('front/practice/index.html.twig', [
            'controller_name' => 'PracticeController',
        ]);
    }
}
