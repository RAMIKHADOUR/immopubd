<?php

namespace App\DataFixtures;

use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Annonces;
use App\Entity\Propertys;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AnnoncesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            // Créer une propriété
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

            // Créer une annonce associée
            $annonce = new Annonces();
            $annonce->setTitle($faker->sentence(3))
                    ->setReference($faker->unique()->regexify('[A-Z]{3}-[0-9]{4}'))
                    ->setImage($faker->imageUrl(640, 480, 'real estate', true, 'Faker'))
                    ->setProperty($property); // Utilisation de setProperty (pas setPropertys)

            $property->setAnnonce($annonce); // Correction ici pour utiliser setAnnonce

            // Persister les entités
            $manager->persist($property);
            $manager->persist($annonce);
        }

        $manager->flush();
    }
}
