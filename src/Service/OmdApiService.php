<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class OmdApiService
{
    private Client $client;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->client = new Client([
            'base_uri' => 'http://www.omdbapi.com/',
        ]);
        $this->entityManager = $entityManager;
    }

    public function searchMovieByTitle(string $title): array
    {
        try {
            $response = $this->client->get('', [
                'query' => [
                    //TODO: a importer depuis .env
                    'apikey' => '2ab9b0e5',
                    //TODO: add verif for tille
                    't' => $title,
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return ['error' => 'Unable to fetch data from the API' . $e->getMessage()];
        } catch (GuzzleException $e) {
            return ['error' => 'Guzzle error: ' . $e->getMessage()];
        }
    }

    public function createMovieFromData(array $data): array
    {
        $movie = new Movie();
        $movie->setTitle($data['Title']);
        $movie->setDirector($data['Director']);
        $movie->setYear((int)$data['Year']);
        $movie->setDescription($data['Plot']);

        $this->entityManager->beginTransaction();
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
        $this->entityManager->commit();

        return [
            'title' => $movie->getTitle(),
            'director' => $movie->getDirector(),
            'year' => $movie->getYear(),
            'description' => $movie->getDescription(),
        ];
    }
}
