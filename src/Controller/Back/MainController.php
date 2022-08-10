<?php
// src/Controller/Back/MainController

namespace App\Controller\Back;

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

    /**
     * Homepage back values are filtered for a better user experience
     * @Route("", name="home")
     */
    public function home(UserRepository $userRepository,
                        PracticeRepository $practiceRepository,
                        QuestionRepository $questionRepository,
                        AnswerRepository $answerRepository,
                        CategoryRepository $categoryRepository): Response
    {
        $users = $userRepository->findBy([], ['id' => 'DESC'], 5);
        $practices = $practiceRepository->findBy([], ['id' => 'DESC'], 5);
        //* Another way to use an array
        $questions = $questionRepository->findBy(array(), array('id' => 'DESC'), 5);
        $answers = $answerRepository->findBy(array(), array('id' => 'Desc'),5);
        $categories = $categoryRepository->findBy(array(), array('id' => 'Desc'),5);

        return $this->render('Back/home.html.twig', [
            'users' => $users,
            'practices' => $practices,
            'questions' => $questions,
            'answers' => $answers,
            'categories'=> $categories,
        ]);
    }
}
