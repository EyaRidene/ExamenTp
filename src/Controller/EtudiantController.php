<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'petudiant.list')]
    public function index(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Etudiant::class);
        $etudiants = $repository->findAll();
        return $this -> render('etudiant/index.html.twig',[
            'etudiant'=>$etudiants
        ]);
    }

    #[Route('/etudiant/add/{nom}/{prenom}', name: 'etudiant.add')]
    public function addEtudiant(ManagerRegistry $doctrine,$nom,$prenom): Response
    {
        $entityManager = $doctrine->getManager();

        $etudiant=new Etudiant();
        $etudiant->setNom($nom);
        $etudiant->setPrenom($prenom);

        $entityManager->persist($etudiant);
        $this->addFlash('succes',"l'etudiant a été ajouté avec succès!");
        $entityManager->flush();


        return $this->redirectToRoute('etudiant.list');
    }
}
