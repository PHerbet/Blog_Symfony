<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'une variable qui va contennir le fake 
        $faker = Faker\Factory::create('fr_FR');
        //Tableau vide pour stocker les Articles générés 
        $arts = [];
        //Tableau vide pour stocker les Utilisateurs générés 
        $users = [];
        //Tableau vide pour stocker les Categories générés 
        $cats = [];
        //Boucles qui va itérer 50 users factices
        for($i=0; $i<50; $i++){
            $user = new User();
            //génération d'un utilisateur factice
            $user->setName($faker->name());
            $user->setFirstName($faker->firstname());
            $user->setMail($faker->email());
            $user->setPassword($faker->password());
            $user->setCreatedAt(new \DateTimeImmutable());
            //stockage dans le manager
            $manager->persist($user);
            $users[] = $user;
            }
        //Boucle qui va itérer 50 catégories factices
        for($i=0; $i<50; $i++){
            $cat = new Category();
            //génération d'une catégorie factice
            $cat->setTitle($faker->sentence());
            $cat->setDescription($faker->paragraph());
            $cat->setCreatedAt(new \DateTimeImmutable());
            //stockage dans le manager
            $manager->persist($cat);
            $cats[] = $cat;
            }
        //Boucle qui va itérer 200 articles factices
        for($i=0; $i<200; $i++){
            $art = new Article();
            //génération d'un article factice
            $art->setTitle($faker->name());
            $art->setContenu($faker->text(255));
            $art->setImage($faker->imageUrl(640, 480, 'animals', true));
            $art->setCreatedAt(new \DateTimeImmutable());
            $art->setWriteBy($faker->randomElement($users));
            $art->addCategory($faker->randomElement($cats));
            //stockage dans le manager
            $manager->persist($art);
            $arts[] = $art;
            }

        $manager->flush();
    }
}
