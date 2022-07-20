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
     * @Route("/answer/new", name="app_answer_new", methods={"POST"})
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

    /**
     * @Route("/answer/{id}/delete", name="answer_delete", methods={"POST"})
     */
    public function answerDelete(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$answer->getId(), $request->request->get('_token'))) {
            $answerRepository->remove($answer, true);
        }

        return $this->redirectToRoute('category_show_question', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/answer/{id}/update", name="answer_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        //* To show question related to anwer
        $question = $answer->getQuestion();

        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $answerRepository->add($answer, true);

            return $this->redirectToRoute('app_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Front/answer/update.html.twig', [
            'question' => $question,
            'answer' => $answer,
            'form' => $form,
        ]);
    }
}
