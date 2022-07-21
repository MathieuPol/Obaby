<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="front_home", methods={"GET"})
     */
    public function home(): Response
    {
        return $this->render('Front/main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contact(): Response
    {
        return $this->render('Front/main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/us", name="us", methods={"GET"})
     */
    public function us(): Response
    {
        return $this->render('Front/main/us.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/phones", name="phones", methods={"GET"})
     */
    public function phones(): Response
    {
        return $this->render('Front/main/phones.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/legal-mentions", name="legal-mentions", methods={"GET"})
     */
    public function legalMentions(): Response
    {
        return $this->render('Front/main/legal-mentions.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
