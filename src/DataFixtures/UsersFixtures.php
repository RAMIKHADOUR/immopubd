<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use DateTimeImmutable;
use App\Entity\Annonces;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{

private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        // Créer plusieurs utilisateurs avec des annonces associées
        for ($i = 0; $i < 5; $i++) {
            $user = new Users();
            $user->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setTeleMobile($faker->phoneNumber)
                ->setEmail($faker->email)
                ->setPassword(
                    $this->passwordHasher->hashPassword($user, 'password123') // Exemple de mot de passe
                );

            // Associer des annonces à l'utilisateur
            for ($j = 0; $j < mt_rand(1, 3); $j++) {
                $annonce = new Annonces();
                $annonce->setTitle($faker->sentence(3))
                        ->setReference($faker->unique()->regexify('[A-Z]{3}-[0-9]{4}'))
                        ->setImage($faker->imageUrl(640, 480, 'real estate', true, 'Faker'))
                        ->setCreatedAt(new DateTimeImmutable())
                        ->setUser($user); // Associer l'annonce à l'utilisateur

                $manager->persist($annonce);
            }

            $manager->persist($user);
        }

       
        $manager->flush();
    }
}
