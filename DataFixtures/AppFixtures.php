<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Commande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();



        // Création d'utilisateurs
        $utilisateurs = [];
        for ($i = 0; $i < 5; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($faker->lastName);
            $utilisateur->setPrenom($faker->firstName);
            $utilisateur->setEmail($faker->email);
            $utilisateur->setPassword(password_hash('password', PASSWORD_BCRYPT));
            $manager->persist($utilisateur);
            $utilisateurs[] = $utilisateur;
        }

        // Création de produits
        $produits = [];
        for ($i = 1; $i <= 10; $i++) {
            $produit = new Produit();
            $produit->setNom($faker->word)
                ->setDescription($faker->sentence)
                ->setPrix($faker->randomFloat(2, 1000, 50000)) // Prix entre 1000 et 50000
                ->setImage("produit_$i.jpg")
                ->setStock($faker->numberBetween(1, 100));

            $manager->persist($produit);
            $produits[] = $produit;
        }

        // Création de commandes
        for ($i = 0; $i < 5; $i++) {
            $commande = new Commande();
            $commande->setUtilisateur($utilisateurs[array_rand($utilisateurs)]);
            $commande->setTotal($faker->randomFloat(2, 100, 5000));
            $commande->setDate($faker->dateTimeThisYear);
            $manager->persist($commande);
        }

        $manager->flush();
    }
}
