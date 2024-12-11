<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Adresses;
use App\Entity\Propertys;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AdressesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Types de voie prédéfinis
        $typesVoie = ['Rue', 'Avenue', 'Boulevard', 'Route', 'Impass'];

        // Générer des propriétés avec des adresses associées
        for ($i = 0; $i < 20; $i++) {
            // Créer une nouvelle propriété
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
                     ->setCamera($faker->boolean());

            // Créer une adresse associée
            $adresse = new Adresses();
            $adresse->setNumeroVoie($faker->numberBetween(1, 200))
                    ->setTypeVoie($faker->randomElement($typesVoie))
                    ->setVoie($faker->streetName())
                    ->setVille($faker->city())
                    ->setCodePostale($faker->postcode())
                    ->setRegion($faker->region())
                    ->setPropertys($property); // Associer l'adresse à la propriété

            $property->setAdresse($adresse); // Associer la propriété à l'adresse

            // Persister les entités
            $manager->persist($adresse);
            $manager->persist($property);
        }


        $manager->flush();
    }
}
