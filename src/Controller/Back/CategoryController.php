<?php
// src/Controller/Back/CategoryController

namespace App\Controller\Back;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/category", name="back_")
 */
class CategoryController extends AbstractController
{

//* List all categories

    /**
     * @Route("", name="category_list", methods={"GET"})
     */
    public function list(CategoryRepository $categoryRepository): Response
    {
        return $this->render('Back/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

//* Add a category

    /**
     * @Route("/add", name="category_add", methods={"GET", "POST"})
     */
    public function add(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);

            return $this->redirectToRoute('app_back_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

//* show a unique category

    /**
     * @Route("/{id}", name="app_back_category_show", methods={"GET"})
     * @param int $id
     */
    public function show(Category $category): Response
    {
        return $this->render('Back/category/show.html.twig', [
            'category' => $category,
        ]);
    }

//* Update an unique category

    /**
     * @Route("/{id}/update", name="category_update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);

            return $this->redirectToRoute('app_back_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

//* Delete an unique category

    /**
     * @Route("/{id}/delete", name="category_delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
        }

        return $this->redirectToRoute('category_list', [], Response::HTTP_SEE_OTHER);
    }
}
