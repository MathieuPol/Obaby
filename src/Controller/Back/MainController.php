<?php
// src/Controller/Back/MainController

namespace App\Controller\Back;

use App\Entity\User;
use App\Repository\AnswerRepository;
use App\Repository\CategoryRepository;
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
                        AnswerRepository $answerRepository,
                        CategoryRepository $categoryRepository): Response
    {
        $users = $userRepository->findBy([], ['id' => 'DESC'], 5);
        $practices = $practiceRepository->findBy([], ['createdAt' => 'DESC'], 5);
        $questions = $questionRepository->findBy(array(), array('createdAt' => 'DESC'), 5);
        $answers = $answerRepository->findBy(array(), array('createdAt' => 'Desc'),5);
        $categories = $categoryRepository->findAll();

        return $this->render('Back/home.html.twig', [
            'users' => $users,
            'practices' => $practices,
            'questions' => $questions,
            'answers' => $answers,
            'categories'=> $categories,
        ]);
    }
}
