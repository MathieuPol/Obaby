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
 * @Route("/back/question", name="back_")
 */
class QuestionController extends AbstractController
{
//* List all questions

    /**
     * @Route("/", name="question_list", methods={"GET"})
     */
    public function list(QuestionRepository $questionRepository): Response
    {
        return $this->render('Back/question/index.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

//* Add a new question
//TODO: To delete

    /**
     * @Route("/new", name="app_question_new", methods={"GET", "POST"})
     */
    public function new(Request $request, QuestionRepository $questionRepository): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->add($question, true);

            return $this->redirectToRoute('app_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/question/new.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

//* Show an unique question

    /**
     * @Route("/{id}", name="question_show", methods={"GET"})
     * @param int $id
     */
    public function show(Question $question): Response
    {
        return $this->render('Back/question/show.html.twig', [
            'question' => $question,
        ]);
    }
    
//* Update an unique question

    //! Have to edit Methods
    /**
     * @Route("/{id}/update", name="question_update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionRepository->add($question, true);

            return $this->redirectToRoute('app_question_index', [], Response::HTTP_SEE_OTHER);
        }
//TODO: Editer les fichiers twig 'edit' en 'update'
        return $this->renderForm('Back/question/edit.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

//* Delete an unique question

    /**
     * @Route("/{id}/delete", name="question_delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Question $question, QuestionRepository $questionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $questionRepository->remove($question, true);
        }

        return $this->redirectToRoute('app_question_index', [], Response::HTTP_SEE_OTHER);
    }

//* Show all answers related to a question
// id is question id

    /**
     * @Route("/{id}/answer", name="question_answer_list", methods={"GET"})
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
}
