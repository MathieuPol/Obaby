<?php
// src/Controller/Back/CategoryController

namespace App\Controller\Back;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Services\SlugService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/back/category", name="back_category_")
 */
class CategoryController extends AbstractController
{

    /**
     * List all categories filter by id descending
     * @Route("", name="list", methods={"GET"})
     */
    public function list(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy(array(), array('id' => 'Desc'));
        return $this->render('Back/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * Add a category
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request, CategoryRepository $categoryRepository, SluggerInterface $sluggerInterface): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre catégorie a bien été ajoutée.');
            //* To not only use our slug service, we use the SluggerInterface service to generate a slug.
            //* This method show a basic way to generate a slug but it repeat some code lines.
            $categorySlug= $sluggerInterface->slug($category->getName())->lower();
            $category->setSlug($categorySlug);
            $categoryRepository->add($category, true);
            
            return $this->redirectToRoute('back_category_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    } 

    /**
     * Update an unique category
     * @Route("/{id}/update", name="update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, Category $category, CategoryRepository $categoryRepository, SlugService $slugService): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre catégorie a bien été éditée.');
            //* To differ whith the previous method (cf line 48), we use OUR slug service to generate a slug.
            $category->setSlug($slugService->slug($category->getName()));
            $categoryRepository->add($category, true);

            return $this->redirectToRoute('back_category_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/category/update.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * Delete an unique category
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $this->addFlash('success', 'Votre catégorie a bien été supprimée.');
            $categoryRepository->remove($category, true);
        }

        return $this->redirectToRoute('back_category_list', [], Response::HTTP_SEE_OTHER);
    }
}