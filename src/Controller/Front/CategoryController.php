<?php
// src/Controller/Front/Category/Controller

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * show category related to questions
     * @Route("/category/question", name="category_show_question", methods={"GET"})
     */
    public function showQuestion(CategoryRepository $categoryRepository): Response
    {
        return $this->render('Front/category/questionList.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * show category related to practices
     * @Route("/category/practice", name="category_show_practice", methods={"GET"})
     */
    public function showPractice(CategoryRepository $categoryRepository): Response
    {
        return $this->render('Front/category/practiceList.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}