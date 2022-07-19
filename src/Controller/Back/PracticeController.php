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
     * @Route("/", name="app_practice_index", methods={"GET"})
     */
    public function index(PracticeRepository $practiceRepository): Response
    {
        return $this->render('practice/index.html.twig', [
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

        return $this->renderForm('practice/new.html.twig', [
            'practice' => $practice,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_practice_show", methods={"GET"})
     */
    public function show(Practice $practice): Response
    {
        return $this->render('practice/show.html.twig', [
            'practice' => $practice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_practice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Practice $practice, PracticeRepository $practiceRepository): Response
    {
        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $practiceRepository->add($practice, true);

            return $this->redirectToRoute('app_practice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('practice/edit.html.twig', [
            'practice' => $practice,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_practice_delete", methods={"POST"})
     */
    public function delete(Request $request, Practice $practice, PracticeRepository $practiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$practice->getId(), $request->request->get('_token'))) {
            $practiceRepository->remove($practice, true);
        }

        return $this->redirectToRoute('app_practice_index', [], Response::HTTP_SEE_OTHER);
    }
}
