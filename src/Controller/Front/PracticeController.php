<?php

namespace App\Controller\Front;

use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Practice;
use App\Form\AnswerType;
use App\Form\PracticeType;
use App\Repository\PracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PracticeController extends AbstractController
{
    /**
     * @Route("/front/practice", name="app_front_practice", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('Front/practice/index.html.twig', [
            'controller_name' => 'PracticeController',
        ]);
    }


    /**
     * @Route("/category/{id}/practice/list", name="practice_list", methods={"GET"})
     */
    public function list(Category $category): Response
    {
        $practices = $category->getPractices();

        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);

        return $this->render('Front/practice/list.html.twig', [
            'practices' => $practices,
            'category' => $category

        ]);
    }

    /**
     * @Route("/practice/submit", name="practice_submit", methods={"GET", "POST"})
     */
    public function submit(Request $request, PracticeRepository $practiceRepository): Response
    {
        $practice = new Practice();
        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $practiceRepository->add($practice, true);

            return $this->redirectToRoute('app_practice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/practice/new.html.twig', [
            'practice' => $practice,
            'form' => $form,
        ]);
    }
}
