<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data=[
            "GL",
            "RT",
            "IIA",
            "IMI",
            "CH",
            "BIO",
            "MPI",
            "CBA"
        ];
        for ($i=1;$i<count($data);$i++){
            $section=new \App\Entity\Section();
            $section->setDesignation($data[$i]);

            $manager->persist($section);
        }
        $manager->flush();

    }

}
