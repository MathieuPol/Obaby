<?php
// src/Controller/Back/QuestionController

namespace App\Controller\Back;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/question/", name="back_question_")
 */
class QuestionController extends AbstractController
{
    /**
     * List all questions filter by id descending
     * @Route("", name="list", methods={"GET"})
     */
    public function list(QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findBy(array(), array('id' => 'DESC'));
        return $this->render('Back/question/index.html.twig', [
            'questions' => $questions,
        ]);
    }

    /**
     * Update an unique question
     * @Route("{id}/update", name="update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->add($question, true);
            $this->addFlash('success', 'Votre question a bien été éditée.');
            return $this->redirectToRoute('back_question_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/question/update.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    /**
     * Delete an unique question
     * @Route("{id}/delete", name="delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $this->addFlash('success', 'Votre question a bien été supprimée.');

            $questionRepository->remove($question, true);
        }

        return $this->redirectToRoute('back_question_list', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * Show all answers related to a question
     * @Route("{id}/answer", name="answer_list", methods={"GET"})
     * @param int $id
     */
    public function answerList(Question $question): Response
    {
        $answers = $question->getAnswers();
        return $this->render('Back/question/answer.html.twig', [
            'question' => $question,
            'answers' => $answers,
        ]);
    }

    /**
     * Validate an unique question
     * @Route("{id}/validate", name="validate", methods={"POST"})
     * @param int $id
     */
    public function validate(Question $question, QuestionRepository $questionRepository)
    {
        $question->setStatus(1);
        $this->addFlash('success', 'Votre question a bien été validée.');
        $questionRepository->add($question, true);
        
        return $this->redirectToRoute('back_question_list', [], Response::HTTP_SEE_OTHER);
    }
}