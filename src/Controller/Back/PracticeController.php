<?php

// src/Controller/Back/PracticeController

namespace App\Controller\Back;

use App\Entity\Practice;
use App\Form\PracticeType;
use App\Repository\PracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/practice", name="back_practice_")
 */
class PracticeController extends AbstractController
{
//* List all practices

    /**
     * @Route("", name="list", methods={"GET"})
     */
    public function list(PracticeRepository $practiceRepository): Response
    {
        return $this->render('Back/practice/index.html.twig', [
            'practices' => $practiceRepository->findAll(),
        ]);
    }

//* Update an unique practice

    //! Have to edit methods
    /**
     * @Route("/{id}/update", name="update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, Practice $practice, PracticeRepository $practiceRepository): Response
    {
        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $practiceRepository->add($practice, true);

            return $this->redirectToRoute('back_practice_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/practice/edit.html.twig', [
            'practice' => $practice,
            'form' => $form,
        ]);
    }

//* Delete an unique plactice

    /**
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Practice $practice, PracticeRepository $practiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$practice->getId(), $request->request->get('_token'))) {
            $practiceRepository->remove($practice, true);
        }

        return $this->redirectToRoute('back_practice_list', [], Response::HTTP_SEE_OTHER);
    }
}
