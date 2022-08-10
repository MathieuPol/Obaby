<?php
// src/Controller/Front/AnswerController 
//* This controller is not used yet but will be used in the future.
//* It is used when user want to modify or delete his own answer.

namespace App\Controller\Front;

use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Answer;
use App\Form\AnswerType;

class AnswerController extends AbstractController
{

    /**
     * Delete an unique answer
     * @Route("/answer/{id}/delete", name="answer_delete", methods={"POST"})
     * @param int $id
     */
    public function answerDelete(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
    if ($answer->getUser() == $this->getUser()) {
        if ($this->isCsrfTokenValid('delete'.$answer->getId(), $request->request->get('_token'))) {
            $answerRepository->remove($answer, true);
        }
    }
    return $this->redirectToRoute('category_show_question', [], Response::HTTP_SEE_OTHER);
}

    /**
     * Update an unique answer
     * @Route("/answer/{id}/update", name="answer_update", methods={"GET", "POST"})
     * @param Int $id
     */
    public function update(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        //* To show question related to anwer
        $question = $answer->getQuestion();

        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);
        if($answer->getUser() == $this->getUser()){
            if ($form->isSubmitted() && $form->isValid()) {
                $answerRepository->add($answer, true);
                
                return $this->redirectToRoute('category_show_question', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->renderForm('Front/answer/update.html.twig', [
            'question' => $question,
            'answer' => $answer,
            'form' => $form,
        ]);
    }
}