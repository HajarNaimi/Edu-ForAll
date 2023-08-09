<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Histoire;
use App\Form\HistoireType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\HistoireRepository;

class HistoireController extends AbstractController
{
    /**
     * @Route("/histoire", name="histoire")
     */
    public function index(request $request , ManagerRegistry $doctrine): Response
    {



            $entityManager = $doctrine->getManager();
        $histoire= new Histoire();

      

        $form = $this->createForm(HistoireType::class, $histoire);
       $form->handleRequest($request);
        if ($form->isSubmitted()) {
         
         $entityManager->persist($histoire);
                 $entityManager->flush();
                 return $this->redirectToRoute("liste");

                 }
        return $this->render('histoire/index.html.twig', [
            'controller_name' => 'HistoireController', 'form' =>  $form->createView(),
        ]);
    }


    /**
     * @Route("/liste", name="liste")
     */
    public function liste(request $request , ManagerRegistry $doctrine , HistoireRepository $histoireRepository): Response
    {
        $histoire= $histoireRepository->findAll();
         return $this->render('histoire/list.html.twig' ,['histoires' =>$histoire]);
}

/**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(request $request , ManagerRegistry $doctrine , HistoireRepository $histoireRepository,$id): Response
    {
           $entityManager = $doctrine->getManager();
        $histoire= $histoireRepository->find($id);
        $entityManager->remove($histoire);
$entityManager->flush();
         return $this->redirectToRoute("liste");
}

/**
     * @Route("/edit", name="edit")
     */
    public function edit(request $request , ManagerRegistry $doctrine , HistoireRepository $histoireRepository): Response
    {  $id=$request->get("id");
              $entityManager = $doctrine->getManager();
        $histoire= $histoireRepository->find($id);

      

        $form = $this->createForm(HistoireType::class, $histoire);
       $form->handleRequest($request);
        if ($form->isSubmitted()) {
         
         $entityManager->persist($histoire);
                 $entityManager->flush();
                return $this->redirectToRoute("liste");

                 }
        return $this->render('histoire/edite.html.twig', [
            'controller_name' => 'HistoireController', 'form' =>  $form->createView(),
        ]);
}
}
