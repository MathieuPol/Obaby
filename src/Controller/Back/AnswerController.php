<?php
//src/Controller/Back/AnswerController

namespace App\Controller\Back;

use App\Entity\Answer;
use App\Form\AnswerType;
use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/answer", name="back_")
 */
class AnswerController extends AbstractController
{

    /**
     * show an unique answer
     * @Route("/{id}", name="answer_show", methods={"GET"})
     * @param int $id
     */
    public function show(Answer $answer): Response
    {
        return $this->render('Back/answer/show.html.twig', [
            'answer' => $answer,
        ]);
    }

    /**
     * display all answers filter by id descending
     * @Route("", name="answer_list", methods={"GET"})
     */
    public function list(AnswerRepository $answerRepository): Response
    {
        $answers = $answerRepository->findBy(array(), array('id' => 'DESC'));
        return $this->render('Back/answer/index.html.twig', [
            'answers' => $answers,
        ]);
    }

    /**
     * Modify an unique answer
     * @Route("/{id}/update", name="answer_update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        //* To show question related to anwer
        $question = $answer->getQuestion();

        //* Create a form type for answer and pass the answer object
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        //* If the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            //* Add flash message
            $this->addFlash('success', 'Votre réponse a bien été éditée.');
            
            //* Modify answer in database
            $answerRepository->add($answer, true);

            //* Redirect to the answer list page
            return $this->redirectToRoute('back_answer_list', [], Response::HTTP_SEE_OTHER);
        }
        //* if the form is not valid or not submited return the form
        return $this->renderForm('Back/answer/update.html.twig', [
            'question' => $question,
            'answer' => $answer,
            'form' => $form,
        ]);
    }

    /**
     * Delete a answer from question list
     * @Route("/{id}/delete", name="answer_delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        //* Protect against cross-site request forgery
        if ($this->isCsrfTokenValid('delete'.$answer->getId(), $request->request->get('_token'))) {
            $this->addFlash('success', 'Votre réponse a bien été supprimée.');
            $answerRepository->remove($answer, true);
        }

        return $this->redirectToRoute('back_answer_list', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Validate an unique answer and allow it to appear on the front page
     * @Route("/{id}/validate", name="question_answer_validate", methods={"POST"})
     * @param int $id 
     */
    public function answerValidate(Answer $answer, AnswerRepository $answerRepository): Response
    {
        $this->addFlash('success', 'Votre réponse a bien été validée.');
        $answer->setStatus(1);
        $answerRepository->add($answer, true);
        return $this->redirectToRoute('back_answer_list', [], Response::HTTP_SEE_OTHER);
    }

}