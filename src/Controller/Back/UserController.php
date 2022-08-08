<?php
// src\Controller\Back\UserController.php

namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Services\SlugService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/user", name="back_user_")
 */
class UserController extends AbstractController
{
    /**
     * List all users filter by id descending
     * @Route("", name="list", methods={"GET"})
     */
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([], ['id' => 'DESC']);
        return $this->render('Back/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * Update an unique user
     * @Route("/{id}/update", name="update", methods={"GET", "POST"})
     * @param int $id
     */
    public function update(Request $request, User $user, UserRepository $userRepository, SlugService $slug): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre utilisateur a bien été édité.');
            $user->setSlug($slug->slug($user->getPseudo()));
            $userRepository->add($user, true);

            return $this->redirectToRoute('back_user_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/user/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * Delete an unique user
     * @Route("/{id}/delete", name="delete", methods={"POST"})
     * @param int $id
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->addFlash('success', 'Votre utilisateur a bien été supprimé.');
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('back_user_list', [], Response::HTTP_SEE_OTHER);
    }
}