<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\UserRepository;
 
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(request $request , ManagerRegistry $doctrine , UserPasswordEncoderInterface $passewordEncoder): Response
    {
        $entityManager = $doctrine->getManager();
        $user = new User();

      

        $form = $this->createForm(UserType::class, $user);
       $form->handleRequest($request);
        if ($form->isSubmitted()) {
             $role=[];
             //die($form->get('roles')->getData());
        $role[]=$form->get('roles')->getData();
        $user->setRoles($role);
         $passeword=$passewordEncoder->encodePassword($user,$user->getPassword()); 
        $user->setPassword($passeword);
        $file=$user->getImage();

        //$file=$form->get('video')->getData();
   //  var_dump($form->getData());die;
       //var_dump($form->getData()) ; 

          $fileName=md5(uniqid()).'.'.$file->guessExtension();
           $file->move($this->getParameter('upload'), $fileName);
           $user->setImage($fileName);
           $role=[];
           $role[]="prof";
           $user->setRoles($role);
         $entityManager->persist($user);
                 $entityManager->flush();
                 return $this->redirectToRoute("liste_user");

                 }
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController', 'form' =>  $form->createView(),
        ]);
    }


     /**
     * @Route("/liste_user", name="liste_user")
     */
    public function liste(request $request , ManagerRegistry $doctrine , UserRepository $UserRepository): Response
    {
        $user= $UserRepository->findAll();
         return $this->render('user/list.html.twig' ,['users' =>$user]);
}

  /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(request $request , ManagerRegistry $doctrine , UserRepository $UserRepository, UserPasswordEncoderInterface $passewordEncoder): Response
    {
        $entityManager = $doctrine->getManager();
        $user = new User();

      

        $form = $this->createForm(UserType::class, $user);
       $form->handleRequest($request);
        if ($form->isSubmitted()) {
          
         $passeword=$passewordEncoder->encodePassword($user,$user->getPassword()); 
        $user->setPassword($passeword);
        $file=$user->getImage();

        //$file=$form->get('video')->getData();
   //  var_dump($form->getData());die;
       //var_dump($form->getData()) ; 

          $fileName=md5(uniqid()).'.'.$file->guessExtension();
           $file->move($this->getParameter('upload'), $fileName);
           $user->setImage($fileName);
           $role=[];
           $role[]="prof";
           $user->setRoles($role);
         $entityManager->persist($user);
                 $entityManager->flush();
                 return $this->redirectToRoute("app_login");

                 }
         return $this->render('inscription.html.twig', ['form' =>  $form->createView()] );
}




/**
     * @Route("/delete_user/{id}", name="delete_user")
     */
    public function delete(request $request , ManagerRegistry $doctrine , UserRepository $userRepository,$id): Response
    {
           $entityManager = $doctrine->getManager();
        $user= $userRepository->find($id);
        $entityManager->remove($user);
$entityManager->flush();
         return $this->redirectToRoute("liste_user");
}


/**
     * @Route("/edit_user", name="edit_user")
     */
    public function edit(request $request , ManagerRegistry $doctrine , UserRepository $userRepository,
    UserPasswordEncoderInterface $passewordEncoder): Response
    {
              $entityManager = $doctrine->getManager();
$id=$request->get("id");
        $user= $userRepository->find($id);
        $image= $user->getImage();
      

        $form = $this->createForm(userType::class, $user);
       $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($user->getImage())
            {
                $file=$user->getImage();

                //$file=$form->get('video')->getData();
           //  var_dump($form->getData());die;
               //var_dump($form->getData()) ; 
        
                  $fileName=md5(uniqid()).'.'.$file->guessExtension();
                   $file->move($this->getParameter('upload'), $fileName);
                   $user->setImage($fileName);
            }
            else {
                $user->setImage($image);
            }
               $role=[];
             //die($form->get('roles')->getData());
        $role[]=$form->get('roles')->getData();
        $user->setRoles($role);
           $passeword=$passewordEncoder->encodePassword($user,$user->getPassword()); 
        $user->setPassword($passeword);
         $entityManager->persist($user);
                 $entityManager->flush();
                return $this->redirectToRoute("liste_user");

                 }
        return $this->render('user/edit.html.twig', [
            'controller_name' => 'HistoireController', 'form' =>  $form->createView(),
        ]);
}
}
