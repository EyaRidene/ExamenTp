<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixture extends Fixture


{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create('fr_FR');
        for ($i=1;$i<20;$i++){
            $etudiant=new Etudiant();
            $etudiant->setPrenom($faker->firstName);
            $etudiant->setNom($faker->name);
            $manager->persist($etudiant);
        }
        $manager->flush();
    }
}
