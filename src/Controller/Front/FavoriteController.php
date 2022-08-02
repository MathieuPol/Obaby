<?php

namespace App\Controller\Front;

use App\Repository\PracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isNull;

/**
 * @route("/favorite", name="favorite_")
 */
class FavoriteController extends AbstractController
{
    //*---------------------------------------------------------------------------------------------------------------------
    //* For having a favorite list we need to use the session and rewrite the favorite list in the session
    //* each time me would use it. 
    private $sessionTab;

    public function __construct(SessionInterface $session)
    {
        $this->sessionTab = $session->get('favorites') ?? [];
    }
    //*---------------------------------------------------------------------------------------------------------------------
    //* route used to add a practice to favorites



    /**
     * @Route("/add", name="add", methods={"POST"})
     * @return Response
     */
    public function add(Request $request, SessionInterface $session, PracticeRepository $practiceRepository)
    {
        //* First we get the practice id from the request
        $practiceId = $request->request->get('id_favorite');

        //* Then we put the practice an array
        array_push($this->sessionTab, $practiceId);
        
        //* we ensure to have an unique array
        $this->sessionTab = array_unique($this->sessionTab);

        //* we put the array in the session 
        $session->set('favorites', $this->sessionTab);

        //* we whrote a message to the user
        $this->addFlash('success', 'Votre seléction a bien été ajoutée à vos favoris');

        //* we catch the practice from the database for using his category name
        $practice = $practiceRepository->find($practiceId);

   
        //* finnaly we redirect to the listing page
        return $this->redirectToRoute(
                'practice_list',
                ['slug' => $practice->getCategory()->getSlug()],
                Response::HTTP_SEE_OTHER
            );
    }

    //* Route used to display favorites list

    /**
     * @Route("", name="list", methods={"GET"})
     */
    public function list(PracticeRepository $practiceRepository)
    {

        //* We consider favoriteList as an array
        $favoritesList = [];

        //* check we need is not empty
        if($this->sessionTab){

            //* We get the favorites from the session
            foreach($this->sessionTab as $idPractice) {
                
                //* And search for the practice in the database
                $favoritesList[] = $practiceRepository->findBy(
                    ['id' => $idPractice]);
                }
            }

        //* finnaly we render the favorite's list page
        return $this->render('Front/favorite/index.html.twig', [
            'practices' => $favoritesList,
        ]);
    }

    //* Route used to remove a practice from favorites
    /**
     * @Route("/delete", name="delete", methods={"POST"})
     * @return Response
     */
    public function delete(Request $request, SessionInterface $session)
    {

        //* First we get the practice id from the request
        $favoriteToDel = $request->request->get('id_favorite');


        //* Then we check if the practice is in the session
            if(!is_Null($this->sessionTab)){

        //* If it is, we remove it from the session
                foreach($this->sessionTab as $index => $fav)
                {
                    if($fav == $favoriteToDel)
                    {
                        unset($this->sessionTab[$index]);
                        //* we overwrite the session with the new array
                        $session->set('favorites', $this->sessionTab);
                    }
                }
            }
        return $this->redirectToRoute('favorite_list');
    }

        //* Route used to remove a practice from favorites
    /**
     * @Route("/delete-all", name="delete_all", methods={"POST"})
     * @return Response
     */
    public function deleteAll(Request $request, SessionInterface $session)
    {
        //* We get the favorite in session
        $favOnSession = $session->get('favorites');
        
        //* if there are favorites in session
            if(!is_Null($favOnSession)){

                //* we remove them from the sessionTab all datas
                unset($this->sessionTab);
                //* we are obliged to overwrite the session with an empty array
                $this->sessionTab = [];
                $session->set('favorites', $this->sessionTab);
            }
        return $this->redirectToRoute('favorite_list');
    }
}
