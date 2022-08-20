<?php
// src/Controller/Front/MainController

namespace App\Controller\Front;

use App\Repository\PracticeRepository;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * Homepage
     * @Route("/", name="front_home", methods={"GET"})
     */
    public function home( QuestionRepository $question, PracticeRepository $practiceRepository, MailerInterface $mailer): Response
    {
        //* show the last five questions(using in carroussel)
        $carrousselQuestion = $question->selectActivatedQuestionsCarroussel();
        //* show the last three practices(using in carroussel)
        $carrousselPractice = $practiceRepository->selectActivatedPracticesHomepage();
        $practice1 = $carrousselPractice[0];
        $practice2 = $carrousselPractice[1];
        $practice3 = $carrousselPractice[2];

        return $this->render('Front/main/index.html.twig', [
            'questionCarroussel' => $carrousselQuestion,
            'practice1' => $practice1,
            'practice2' => $practice2,
            'practice3' => $practice3,
        ]);
    }

    /**
     * Page contact
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contact(): Response
    {
        return $this->render('Front/main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * Page about us
     * @Route("/about-us", name="about_us", methods={"GET"})
     */
    public function aboutUs(): Response
    {
        return $this->render('Front/main/aboutUs.html.twig', [
        ]);
    }
    
    /**
     * Page phones
     * @Route("/phones", name="phones", methods={"GET"})
     */
    public function phones(): Response
    {
        return $this->render('Front/main/phones.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    
    /**
     * Page legal mentions
     * @Route("/legal-mentions", name="legal_mentions", methods={"GET"})
     */
    public function legalMentions(): Response
    {
        return $this->render('Front/main/legal-mentions.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}