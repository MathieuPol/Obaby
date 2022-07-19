<?php

namespace App\Controller\Back;

use App\Entity\Practice;
use App\Form\PracticeType;
use App\Repository\PracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/practice")
 */
class PracticeController extends AbstractController
{
    /**
     * @Route("/", name="practice_list", methods={"GET"})
     */
    public function list(PracticeRepository $practiceRepository): Response
    {
        return $this->render('Back/practice/index.html.twig', [
            'practices' => $practiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_practice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PracticeRepository $practiceRepository): Response
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

    /**
     * @Route("/{id}", name="app_practice_show", methods={"GET"})
     */
    public function show(Practice $practice): Response
    {
        return $this->render('Back/practice/show.html.twig', [
            'practice' => $practice,
        ]);
    }

    //! Have to edit methods
    /**
     * @Route("/{id}/update", name="practice_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Practice $practice, PracticeRepository $practiceRepository): Response
    {
        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $practiceRepository->add($practice, true);

            return $this->redirectToRoute('app_practice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/practice/edit.html.twig', [
            'practice' => $practice,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="practice_delete", methods={"POST"})
     */
    public function delete(Request $request, Practice $practice, PracticeRepository $practiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$practice->getId(), $request->request->get('_token'))) {
            $practiceRepository->remove($practice, true);
        }

        return $this->redirectToRoute('Back/app_practice_index', [], Response::HTTP_SEE_OTHER);
    }
}
