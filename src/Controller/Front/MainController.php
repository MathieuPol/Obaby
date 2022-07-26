<?php
// src/Controller/Front/MainController

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
//* Homepage route

    /**
     * @Route("/", name="front_home", methods={"GET"})
     */
    public function home(): Response
    {
        return $this->render('Front/main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

//* Contact route

    /**
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contact(): Response
    {
        return $this->render('Front/main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

//* aboutUs route

    /**
     * @Route("/about-us", name="about_us", methods={"GET"})
     */
    public function aboutUs(): Response
    {
        return $this->render('Front/main/aboutUs.html.twig', [
        ]);
    }
    
    //* Phone route
    
    /**
     * @Route("/phones", name="phones", methods={"GET"})
     */
    public function phones(): Response
    {
        return $this->render('Front/main/phones.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    
    //* legal-mentions route
    
    /**
     * @Route("/legal-mentions", name="legal_mentions", methods={"GET"})
     */
    public function legalMentions(): Response
    {
        return $this->render('Front/main/legal-mentions.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}