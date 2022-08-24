<?php

namespace App\Controller\Front;

use App\Repository\PracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @route("/favorite", name="favorite_")
 */
class FavoriteController extends AbstractController
{
    //* For having a favorite list we need to use the session and rewrite the favorite list in the session
    //* each time me would use it. 
    private $sessionTab;

    public function __construct(RequestStack $requestStack)
    {
        //*if the session is empty we create a new array to store the favorite list
        $this->sessionTab = $requestStack->getCurrentRequest()->getSession('favorites') ?? [];
    }

    /**
     * Add to favorite list
     * @Route("/add", name="add", methods={"POST"})
     * @return Response
     */
    public function add(Request $request, PracticeRepository $practiceRepository)
    {

        //* First we get the practice id from the request
        $practiceId = $request->request->get('id_favorite');

        //* Then we get the favorites in session
        $favoriteInSession = $this->sessionTab->get('favorites');
        
        //* Then we put the new session item in an array with previous favorites item
        array_push($favoriteInSession, $practiceId);

        //* We ensure that the array is unique(no duplicate)
        $favoriteInSession = array_unique($favoriteInSession);

        //* We put the new array in the session
        $this->sessionTab->set('favorites', $favoriteInSession);
        
        //* we whrote a message to the user
        $this->addFlash('success', 'Votre sélection a bien été ajoutée à vos favoris');

        //* we catch the practice from the database for using his category name
        $practice = $practiceRepository->find($practiceId);


        //* finnaly we redirect to the listing page
        return $this->redirectToRoute(
            'practice_list',
            ['slug' => $practice->getCategory()->getSlug()],
            Response::HTTP_SEE_OTHER
        );
    }

    /**
     * Display favorites list
     * @Route("", name="list", methods={"GET"})
     */
    public function list(PracticeRepository $practiceRepository)
    {
        //* We consider favoriteList as an array
        $favoritesList = [];
        //* check we need is not empty
        if ($this->sessionTab->get('favorites') != null) {
            //* We get the favorites from the session
            foreach ($this->sessionTab as $idPractice) {

                //* And search for the practice in the database
                $favoritesList[] = $practiceRepository->findBy(
                    ['id' => $idPractice]
                );
            }
        }

        //* finnaly we render the favorite's list page
        return $this->render('Front/favorite/index.html.twig', [
            'practices' => $favoritesList,
        ]);
    }

     /**
     * Delete an unique favorite practice
     * @Route("/delete", name="delete", methods={"POST"})
     * @return Response
     */
    public function delete(Request $request): Response
    {

        //* we get the practice id from the request
        $favoriteToDel = $request->request->get('id_favorite');

        //* Then we check if the practice is in the session
        if (!is_Null($this->sessionTab->get('favorites'))) {

            //* We get the array of favorites from the session
            $favorites = $this->sessionTab->get('favorites');

            //* If it is, we remove it from the session
            foreach ($favorites as $index => $fav) {
                if ($fav == $favoriteToDel) {
                    unset($favorites[$index]);

                    //* we overwrite the session with the new array
                    $this->sessionTab->set('favorites', $favorites);
                    $this->addFlash('danger', 'Votre sélection a bien été supprimée.');
                }
            }
        }
        return $this->redirectToRoute('favorite_list');
    }

    /**
     * Delete all favorites List
     * @Route("/delete-all", name="delete_all", methods={"POST"})
     * @return Response
     */
    public function deleteAll(): Response
    {
        //* if there are favorites in session
        if (!is_Null($this->sessionTab->get('favorites'))) {
            //* we delete the session
            $this->sessionTab->set('favorites', []);
            $this->addFlash('danger', 'Tous vos favoris ont bien été supprimés.');
        }
        return $this->redirectToRoute('favorite_list');
    }
}
