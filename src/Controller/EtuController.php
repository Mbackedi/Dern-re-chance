<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Service;
use App\Entity\Employer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EtuController extends AbstractController
{
    /**
     * @Route("/etu", name="etu")
     */
    public function index()
    {
        return $this->render('etu/index.html.twig', [
            'controller_name' => 'EtuController',
        ]);
    }

   /**
    * @Route("/", name="acceuil")
    */

    public function acceuil(){
        return $this->render('etu/acceuil.html.twig');  
    }

    /**
     * @Route("/etu/new", name="etu_creer")
     * @Route("/etu/{id}/modserv", name="modif_serv")
     */
    public function creer(Service $service=null, Request $request, ObjectManager $manager){

        if(!$service){
            $service = new Service();
        }

        $rep=$this->getDoctrine()->getRepository(Service::class);
        $serv=$rep->findAll();

         
         $form = $this->createFormBuilder($service)
                 ->add('libelle')
                 ->getForm();

                 $form->handleRequest($request);
                 if($form->isSubmitted() && $form->isValid()){
                     $manager->persist($service);
                     $manager->flush();
            return $this->redirectToRoute('etu_creer');

                 }

        return $this->render('etu/creer.html.twig', [
            'formService' => $form->createView(),
            'serv'=>$serv,
            'mod'=>$service->getId()!==null
        ]);

        return $this->render('etu_creer');
    }

    /**
     * @Route("/etu/newemp", name="etu_creeremp")
     * @Route("/etu/{id}/modemp", name="modif_emp")
     */       

    public function create(Employer $employer=null, Request $request, ObjectManager $manager){
        
        if(!$employer){
            $employer = new Employer();
        }
      $rep=$this->getDoctrine()->getRepository(Employer::class);
      $emp=$rep->findAll();

       
        $form = $this->createFormBuilder($employer)
        ->add('matricule')
        ->add('NomComplet')
        ->add('dateNaiss', DateType::class,[
            'widget'=>'single_text',
            'format'=>'yyyy-MM-dd'
        ])
        ->add('salaire')
        ->add('Service', EntityType::class,[
            'class'=>Service::class,
            'choice_label' =>'libelle'
        ])
        ->getForm();

         $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($employer);
            $manager->flush();
            return $this->redirectToRoute('etu_creeremp');
        }



        return $this->render('etu/creeremp.html.twig', [
            'formEmployer' => $form->createView(),
            'emp'=>$emp,
            'modiff'=>$employer->getId()!==null
        ]);

        return $this->render('etu_creeremp');

    }

    /**
     
     * @Route("/etu/{id}/supprime", name="supprime_serv")
     */


public function supprim(Service $service=null, ObjectManager $manager){

    $manager->remove($service);
    $manager->flush();
    return $this->redirectToRoute('etu_creer');
}


    /**
     
     * @Route("/etu/{id}/suppemp", name="supp_emp")
     */


    public function supprimer(Employer $employer=null, ObjectManager $manager)
    {
        $manager->remove($employer);
        $manager->flush();
        return $this->redirectToRoute('etu_creeremp');
    }



}
