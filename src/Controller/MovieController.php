<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Service\OmdApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class MovieController
{
    private EntityManagerInterface $entityManager;
    private OmdApiService $omdApiService;

    public function __construct(EntityManagerInterface $entityManager, OmdApiService $omdApiService)
    {
        $this->entityManager = $entityManager;
        $this->omdApiService = $omdApiService;
    }
    public function __invoke(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);

        $searchTerm = $requestData['title'] ?? '';

        $moviesRepo = $this->entityManager->getRepository(Movie::class);
        $movies = $moviesRepo->findBy(['title' => $searchTerm]);

        if (empty($movies)) {
            $apiResponse = $this->omdApiService->searchMovieByTitle($searchTerm);

            if (isset($apiResponse['error'])) {
                return new JsonResponse(['error' => $apiResponse['error']], 404);
            }

            $movie = $this->omdApiService->createMovieFromData($apiResponse);
            return new JsonResponse($movie, 200);
        }

        return new JsonResponse($movies);
    }
}
