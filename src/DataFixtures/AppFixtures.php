<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movies = [
            [
                'title' => 'Inception',
                'director' => 'Christopher Nolan',
                'year' => 2010,
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.',
            ],
            [
                'title' => 'The Matrix',
                'director' => 'The Wachowskis',
                'year' => 1999,
                'description' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
            ],
        ];

        foreach ($movies as $data) {
            $movie = new Movie();
            $movie->setTitle($data['title']);
            $movie->setDirector($data['director']);
            $movie->setYear($data['year']);
            $movie->setDescription($data['description']);
            $manager->persist($movie);
        }


        $manager->flush();
    }
}
