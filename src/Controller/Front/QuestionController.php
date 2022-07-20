<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/front/question", name="app_front_question")
     */
    public function index(): Response
    {
        return $this->render('front/question/index.html.twig', [
            'controller_name' => 'QuestionController',
        ]);
    }
}
