<?php

// src/Controller/Back/PracticeController

namespace App\Controller\Back;

use App\Entity\Practice;
use App\Form\PracticeType;
use App\Repository\PracticeRepository;
use App\Services\SlugService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/practice", name="back_practice_")
 */
class PracticeController extends AbstractController
{

    /**
     * Display  all practices filtered by id descending.
     * @Route("", name="list", methods={"GET"})
     */
    public function list(PracticeRepository $practiceRepository): Response
    {
        $practices = $practiceRepository->findBy([], ['id' => 'DESC']);
        return $this->render('Back/practice/index.html.twig', [
            'practices' => $practices,
        ]);
    }

    /**
     * Update an unique practice
     * @Route("/{id}/update", name="update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, Practice $practice, PracticeRepository $practiceRepository, SlugService $slugService): Response
    {
        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre question a bien été éditée.');
            $practice->setSlug($slugService->slug($practice->getTitle()));
            $practiceRepository->add($practice, true);
            return $this->redirectToRoute('back_practice_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/practice/update.html.twig', [
            'practice' => $practice,
            'form' => $form,
        ]);
    }


    /**
     * Delete an unique plactice
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Practice $practice, PracticeRepository $practiceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$practice->getId(), $request->request->get('_token'))) {
            $this->addFlash('success', 'Votre question a bien été supprimée.');
            $practiceRepository->remove($practice, true);
        }

        return $this->redirectToRoute('back_practice_list', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * validate an unique practice and allow to see it in the front
     * @Route("/{id}/validate", name="validate", methods={"POST"})
     */
    public function validate(Practice $practice, PracticeRepository $practiceRepository)
    {
        $practice->setStatus(1);
        $this->addFlash('success', 'Votre question a bien été validée.');
        $practiceRepository->add($practice, true);
        return $this->redirectToRoute('back_practice_list', [], Response::HTTP_SEE_OTHER);
    }
}