<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Boolean;

class AppFixtures extends Fixture

{
    private const COUNTRY_NAMES = ['China', 'Japan', 'Russia', 'Mongolia', 'Indonesia', 'Malaysia', 'Vietnam', 'Kazakhstan', 'India']; 
    public function load(ObjectManager $manager): void
    {
        $countries = [];
        $countryMap = [];

        foreach (self::COUNTRY_NAMES as $countryName) {
            $country = new Country();
            $country->setName($countryName);
            $manager->persist($country);
            $countries[] = $country;
            $countryMap[$countryName] = $country;
        }

        $articlesData =  [
            [
                'title' => 'Le Dragon Well (Longjing)',
                'description' => 'Découverte du thé le plus apprécié de Chine.',
                'content' => 'Le type de thé vert chinois le plus apprécié et le plus connu est le thé Dragon Well (Longjing)...',
                'dateCreated' => new \DateTime('2025-04-01'),
                'visible' => true,
                'countryName' => 'China',
            ],
            [
                'title' => 'Le matcha japonais',
                'description' => 'Exploration de ce thé qui cartonne chez nous',
                'content' => 'Le matcha est bien plus qu\'une simple poudre verte...',
                'dateCreated' => new \DateTime('2025-05-12'),
                'visible' => true,
                'countryName' => 'Japan'
            ],
            [
                'title' => 'Thé du tsar',
                'description' => 'Tradition du thé russe et samovars',
                'content' => 'Le thé est profondément ancré dans la culture russe, souvent partagé en famille...',
                'dateCreated' => new \DateTime('2024-06-12'),
                'visible' => true,
                'countryName' => 'Russia',
            ],
            [
                'title' => 'Süütei tsai',
                'description' => 'Une aventure à travers les steppes mongoles',
                'content' => 'Peu connue pour son thé, la Mongolie réserve pourtant des surprises, ce thé salé au lait de jument...',
                'dateCreated' => new \DateTime('2024-06-20'),
                'visible' => true,
                'countryName' => 'Mongolia',
            ],
            [
                'title' => 'Thé noir orthodoxe',
                'description' => 'Saveurs et senteurs du thé en Malaisie',
                'content' => 'La Malaisie mêle traditions chinoises, indiennes et malaises dans sa culture du thé...',
                'dateCreated' => new \DateTime('2024-06-20'),
                'visible' => false,
                'countryName' => 'Malaysia',
            ],
        ];

        foreach ($articlesData as $articleData) {
        $article = new Article();
        $article->setTitle($articleData['title']);
        $article->setDescription($articleData['description']);
        $article->setContent($articleData['content']);
        $article->setDateCreated($articleData['dateCreated']);
        $article->setVisible(true);

        //Association de l'article avec l'objet Country
        $article->setCountry($countryMap[$articleData['countryName']]);

        $manager->persist($article);
    }

        $manager->flush();
    }
}

// créer liste de pays dans load -> y faire référence quand je crée mes country
