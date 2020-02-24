<?php
namespace App\Controller;

use App\Repository\RecipesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @Route("/lunch", methods={"POST"})
     */
    public function lunch(Request $request, RecipesRepository $repository)
    {

        $lunch = $repository->lunch();

        dd($lunch);
    }
}