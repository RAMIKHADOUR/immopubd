<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Propertys;
use App\Entity\Typesbien;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypesbienFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $faker = Factory::create('fr_FR');

        // Types prédéfinis
        $typesBiens = ['Appartement', 'Maison', 'Terrain', 'Commercial'];

        // Créer chaque type de bien
        foreach ($typesBiens as $typeBien) {
            $type = new Typesbien();
            $type->setTypeBien($typeBien);

            // Ajouter des propriétés pour chaque type
            for ($i = 0; $i < mt_rand(5, 10); $i++) { // Entre 5 et 10 propriétés par type
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
                         ->setTypesbien($type); // Associer la propriété au type de bien

                $manager->persist($property);
            }

            $manager->persist($type);
        }
        $manager->flush();
    }
}
