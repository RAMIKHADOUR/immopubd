<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Propertys;
use App\Entity\Categorysbien;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorysbienFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $faker = Factory::create('fr_FR');

        // Catégories prédéfinies
        $categories = ['Location', 'Vendre'];

        // Créer chaque catégorie
        foreach ($categories as $cat) {
            $category = new Categorysbien();
            $category->setCategorie($cat);

            // Ajouter des propriétés pour chaque catégorie
            for ($i = 0; $i < mt_rand(5, 10); $i++) { // Entre 5 et 10 propriétés par catégorie
                $property = new Propertys();
                $property->setSurface($faker->randomFloat(2, 20, 500))
                         ->setPrix($faker->randomFloat(2, 50000, 1000000))
                         ->setDescription($faker->text(200))
                         ->setChambres($faker->numberBetween(1, 10))
                         ->setSallebains($faker->numberBetween(1, 5))
                         ->setEtages($faker->numberBetween(0, 5))
                         ->setNumeroEtage($faker->numberBetween(0, 5))
                         ->setInternet($faker->boolean())
                         ->setGarage($faker->boolean())
                         ->setPiscine($faker->boolean())
                         ->setCamera($faker->boolean())
                         ->setCategorysbien($category); // Associer la propriété à la catégorie

                $manager->persist($property);
            }

            $manager->persist($category);
        }
        $manager->flush();
    }
}
