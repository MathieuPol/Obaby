<?php
// src/Controller/Back/MainController

namespace App\Controller\Back;

use App\Entity\User;
use App\Repository\AnswerRepository;
use App\Repository\PracticeRepository;
use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
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
    public function home(UserRepository $userRepository,
                        PracticeRepository $practiceRepository,
                        QuestionRepository $questionRepository,
                        AnswerRepository $answerRepository ): Response
    {
        $users = $userRepository->findAll();
        $practices = $practiceRepository->findAll();
        $questions = $questionRepository->findAll();
        $answers = $answerRepository->findAll();

        return $this->render('Back/home.html.twig', [
            'users' => $users,
            'practices' => $practices,
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }
}
