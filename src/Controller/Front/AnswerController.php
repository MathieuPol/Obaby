<?php

namespace App\Controller\Front;

use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Answer;


class AnswerController extends AbstractController
{
    /**
     * @Route("/answer", name="app_front_answer")
     */
    public function index(): Response
    {
        return $this->render('front/answer/index.html.twig', [
            'controller_name' => 'AnswerController',
        ]);
    }

    /**
     * @Route("/new", name="app_answer_new", methods={"POST"})
     */
    public function new(Request $request, AnswerRepository $answerRepository): Response
    {
        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $answerRepository->add($answer, true);

            return $this->redirectToRoute('app_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Front/answer/new.html.twig', [
            'answer' => $answer,
            'form' => $form,
        ]);
    }
}
