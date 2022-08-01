<?php

namespace App\Controller\Front;

use App\Repository\PracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route("/favorite", name="favorite_")
 */
class FavoriteController extends AbstractController
{

    //* route used to add a practice to favorites

    /**
     * @Route("/add", name="add", methods={"POST"})
     * @return Response
     */
    public function add(Request $request, SessionInterface $session, PracticeRepository $practiceRepository)
    {
        //* First we get the practice id from the request
        $practiceId = $request->request->get('id_favorite');

        //* Then we get the practice from the database
        $practice = $practiceRepository->find($practiceId);

        //* Then we get the favorites from the session and check if the practice is already in the favorites
        $favorites = $session->get('favorites');
        if (is_null($favorites)) {
            $favorites = [];
        }
        //* If not in we add it
        if (!in_array($practiceId, $favorites)) {
            $favorites[] = $practiceId;
            $this->addFlash('success', 'Votre séléction a bien été ajouté à vos favoris');
        }
        $session->set('favorites', $favorites);

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
    public function list(SessionInterface $session, PracticeRepository $practiceRepository)
    {

        //* We consider favoriteList as an array
        $favoritesList = [];

        //* We get the favorites from the session
        foreach($session->get('favorites') as $idPractice) {

        //* And search for the practice in the database
            $favoritesList[] = $practiceRepository->findBy(
                ['id' => $idPractice]);
        }

        //* finnaly we render the favorite's list page
        return $this->render('Front/favorite/index.html.twig', [
            'practices' => $favoritesList,
        ]);
    }
}
