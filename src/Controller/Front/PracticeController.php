<?php
// src/Controller/Front/PracticeController

namespace App\Controller\Front;

use App\Entity\Category;
use App\Entity\Practice;
use App\Form\PracticeType;
use App\Repository\CategoryRepository;
use App\Repository\PracticeRepository;
use App\Services\SlugService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PracticeController extends AbstractController
{
    /**
     * display practices list
     * @Route("/category/{slug}/practice/list", name="practice_list", methods={"GET"})
     */
    public function list(
        Category $category,
        CategoryRepository $categoryRepository,
        PracticeRepository $practiceRepository
    ): Response {
        $practices = $practiceRepository->selectActivatedPractices(
            $category->getId()
        );
        $categories = $categoryRepository->findAll();

        return $this->render('Front/practice/list.html.twig', [
            'practices' => $practices,
            'categoryList' => $categories,
            'category' => $category,
        ]);
    }

    /**
     * Submit a new practice
     * @Route("/practice/submit", name="practice_submit", methods={"GET", "POST"})
     */
    public function submit(
        Request $request,
        PracticeRepository $practiceRepository,
        SlugService $slugService
    ): Response {
        $practice = new Practice();
        $form = $this->createForm(PracticeType::class, $practice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash(
                'success', 'Votre bonne pratique a bien été enregistrée. Elle est en attente de modération.'
            );
            $practice->setSlug($slugService->slug($practice->getTitle()));
            $practice->setUser($this->getUser());
            $practiceRepository->add($practice, true);

            return $this->redirectToRoute(
                'category_show_practice',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('Front/practice/new.html.twig', [
            'practice' => $practice,
            'form' => $form,
        ]);
    }

    //* Regex Explanation: used to match at least one character in the slug request parameter
    /**
     * Show a unique practice
     * @Route(
     *      "/practice/{slug}",
     *      name="practice_show",
     *      methods={"GET"},
     *      requirements={"slug"="[\w-]+"})
     *
     * @param string $slug
     * @return Response
     */
    public function show(
        string $slug,
        PracticeRepository $practiceRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $dataPractice = $practiceRepository->findOneBy(['slug' => $slug]);
        $category = $dataPractice->getCategory();
        $categories = $categoryRepository->findAll();
        // If the slug contains an index that does not exist
        if (is_null($dataPractice)) {
            throw $this->createNotFoundException('Cette bonne pratique n\'existe pas.');
        }

        // we return the twig template in which we transmit the data of the good practice requested in parameter
        return $this->render('Front/practice/practice-show.html.twig', [
            'practice' => $dataPractice,
            'category' => $category,
            'categories' => $categories,
                ]);
    }
}