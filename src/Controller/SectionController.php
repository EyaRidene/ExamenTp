<?php

namespace App\Controller;

use App\Entity\Section;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SectionController extends AbstractController
{
    #[Route('/section', name: 'app_section')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Section::class);
        $sections = $repository->findAll();
        return $this -> render('section/index.html.twig',[
            'sections'=>$sections
        ]);
    }
}
