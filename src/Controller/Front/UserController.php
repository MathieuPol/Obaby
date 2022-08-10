<?php
//src/Controller/Front/UserController

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\NewUserType;
use App\Form\UserUpdateType;
use App\Repository\AnswerRepository;
use App\Repository\PracticeRepository;
use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
use App\Services\SlugService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * Add a new user
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

    /**
     * Show personnal informations
     * @Route ("/{slug}", name="show", methods={"GET"})
     * @param int $id
    */
    public function show(User $user): Response
    {
        return $this->render('Front/user/personnalInformation.html.twig', [
            'user' => $user,
        ]);
    }
    
    /**
     * Update personnal informations
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
            return $this->redirectToRoute('user_show', ['slug' => $user->getSlug()], Response::HTTP_SEE_OTHER);
        }  
        
        return $this->renderForm('Front/user/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * User delete his account
     * @Route ("/{id}/delete", name="delete", methods={"POST"})
     * @param int $id
    */
    public function delete(Request $request, User $user, UserRepository $userRepository, QuestionRepository $questionRepository, PracticeRepository $practice, AnswerRepository $answerRepository, Session $session): Response
    {

        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {

            //* First we get the user Anonymous
            $anonymous = $userRepository->findOneBy(['pseudo' => 'Anonymous']);
            //* Then we get all the questions(if there are) of the user
            //* and we change the user of the question to the anonymous and delete from the user
            if ( $user->getQuestions() ) {
                foreach ($user->getQuestions() as $key => $value) {
                    $value->setUser($anonymous);
                    $questionRepository->add($value, true);
                    $user->removeQuestion($value);
                }
            }
            //* Same as above but for the practices
            if ( $user->getPractices() ) {
                foreach ($user->getPractices() as $key => $value) {
                    $value->setUser($anonymous);
                    $practice->add($value, true);
                    $user->removePractice($value);
                }
            }
            //* Same as above but for the answers
            if ( $user->getAnswers() ) {
                foreach ($user->getAnswers() as $key => $value) {
                    $value->setUser($anonymous);
                    $answerRepository->add($value, true);
                    $user->removeAnswer($value);
                }
            }
            //* Finally we delete the user
            $userRepository->remove($user, true);
            //* We override the user's session with another one
            $session = new Session();
            //* We delete the session to avoid errors
            $session->invalidate();
        }

        return $this->redirectToRoute('security_logout', []);
    }

}