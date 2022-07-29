<?php
//src/Controller/Front/UserController


namespace App\Controller\Front;

use App\Entity\User;
use App\Form\NewUserType;
use App\Form\UserType;
use App\Form\UserUpdateType;
use App\Repository\UserRepository;
use App\Services\SlugService;
use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
//* Route to add a new user

    /**
     * @Route ("/new", name="new", methods={"GET","POST"})
     * @param int $id
    */
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher, SlugService $slug): Response
    {
        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre compte a été créé ! Vous pouvez dès à présent vous connecter.');
            $plaintextPassword= $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user->setStatus(1);
            $user->setRoles(['ROLE_USER']);
            $user->setSlug($slug->slug($user->getPseudo()));
            $userRepository->add($user, true);

            return $this->redirectToRoute('security_login', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('Front/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


//* Route to show personnal informations
    /**
     * @Route ("/{id}", name="show", methods={"GET"})
    */
    public function show(User $user): Response
    {
        return $this->render('Front/user/personnalInformation.html.twig', [
            'user' => $user,
        ]);
    }
    
//* Route to update personnal informations
    /**
     * @Route ("/{id}/update", name="update", methods={"POST", "GET"})
     * @param int $id
    */
    public function update(User $user, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        //create form with User
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plaintextPassword= $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $userRepository->add($user, true);
            return $this->redirectToRoute('user_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }  
        
        return $this->renderForm('Front/user/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    //* Route to delete account
    /**
     * @Route ("/{id}/delete", name="delete", methods={"POST"})
     * @param int $id
    */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        //TODO transférer le contenu de cet utilisateur vers utilisateur anonyme
/*         $userPractices = [];
        $userAnswers = [];
        $userQuestion = [];
        foreach ($userPractices as $key => $value) {
            $userAnonimous->setPractices($value);
            $userRepository->add($userAnonimous, true);
        } */



        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('Front/main/index.html.twig', [], Response::HTTP_SEE_OTHER);
    }


}