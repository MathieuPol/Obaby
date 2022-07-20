<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController extends AbstractController
{
    /**
     * @Route("/front/answer", name="app_front_answer")
     */
    public function index(): Response
    {
        return $this->render('front/answer/index.html.twig', [
            'controller_name' => 'AnswerController',
        ]);
    }
}
