<?php
// src/Controller/Back/MainController

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/", name="back_")
 */
class MainController extends AbstractController
{
//* Homepage back

    /**
     * @Route("", name="home")
     */
    public function home(): Response
    {
        return $this->render('Back/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
