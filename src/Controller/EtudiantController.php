<?php

namespace App\Controller;

use App\Entity\Etudiant;

use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'etudiant.list')]
    public function index(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Etudiant::class);
        $etudiants = $repository->findAll();
        return $this -> render('etudiant/index.html.twig',[
            'etudiants'=>$etudiants
        ]);
    }

    #[Route('/etudiant/form/{id?0}', name: 'etudiant.form')]
    public function EtudiantForm(Etudiant $etudiant  = null , ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $new=false;
        if (!$etudiant){
            $new = true;
            $etudiant= new Etudiant();
        }

        $form=$this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){
            $manager = $doctrine->getManager();
            $manager->persist($etudiant);


                $manager->flush();
                if ($new){
                    $this->addFlash('succes',"Etudiant ajouté avec succès !");
                }else{
                    $this->addFlash('succes',"Etudiant mis à jour avec succès !");
                }

                return $this->redirectToRoute('etudiant.list');
            }


            return $this->render('etudiant/form.html.twig', [

                'form'=>$form->createView()
            ]);
        }

    #[Route('/étudiant/delete/{id}', name: 'etudiant.delete')]
    public function deleteEtudiant(Etudiant $etudiant=null , ManagerRegistry $doctrine): Response
    {
        if ($etudiant) {
            $manager = $doctrine->getManager();
            $manager->remove($etudiant);
            $manager->flush();
            $this->addFlash('succes',"Etudiant supprimé avec succès !");
        }

        else{
            $this->addFlash('error',"Etudiant inexistant!");
        }
        return $this->redirectToRoute('etudiant.list');
    }


}
