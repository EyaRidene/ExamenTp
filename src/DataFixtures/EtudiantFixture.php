<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixture extends Fixture


{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $repo = $manager->getRepository(Section::class);

        for ($i = 0; $i < 20; $i++) {
            $etudiant = new Etudiant();
            $etudiant->setPrenom($faker->firstName);
            $etudiant->setNom($faker->name);
            $random = rand(1, 8);
            $Section = $repo->findOneBy(array('id' => $random));
            $etudiant->setSection($Section);
            $manager->persist($etudiant);
        }
        $manager->flush();
    }

}