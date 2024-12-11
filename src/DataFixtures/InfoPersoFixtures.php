<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\InfoPerso;
use App\Entity\Propertys;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InfoPersoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Liste des civilités possibles
        $civilites = ['M', 'Mme'];

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

            // Créer une nouvelle info personnelle associée
            $infoPerso = new InfoPerso();
            $infoPerso->setCivilite($faker->randomElement($civilites))
                      ->setNom($faker->lastName())
                      ->setPrenom($faker->firstName())
                      ->setEmail($faker->unique()->safeEmail())
                      ->setTeleMobile($faker->phoneNumber())
                      ->setPropertys($property); // Associer InfoPerso à Propertys

            $property->setInfosperso($infoPerso); // Corriger ici pour utiliser le bon nom de méthode

            // Persister les entités
            $manager->persist($infoPerso);
            $manager->persist($property);
        }

        $manager->flush();
    }
}
