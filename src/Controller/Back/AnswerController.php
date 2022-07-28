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
     * @Route("", name="answer_list", methods={"GET"})
     */
    public function list(AnswerRepository $answerRepository): Response
    {
        return $this->render('Back/answer/index.html.twig', [
            'answers' => $answerRepository->findAll(),
        ]);
    }

//* Modify an unique answer

    /**
     * @Route("/{id}/update", name="answer_update", methods={"GET", "POST"})
     * @param int $id
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

        return $this->renderForm('Back/answer/edit.html.twig', [
            'question' => $question,
            'answer' => $answer,
            'form' => $form,
        ]);
    }

//* Delete a answer from question list

    /**
     * @Route("/{id}/delete", name="answer_delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Answer $answer, AnswerRepository $answerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$answer->getId(), $request->request->get('_token'))) {
            $answerRepository->remove($answer, true);
        }

        return $this->redirectToRoute('app_answer_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/validate", name="question_answer_validate", methods={"POST"})
     */
    public function answerValidate(Answer $answer, AnswerRepository $answerRepository)
    {
        $answer->setStatus(1);
        $answerRepository->add($answer, true);
        return $this->redirectToRoute('back_answer', [], Response::HTTP_SEE_OTHER);
    }

}
