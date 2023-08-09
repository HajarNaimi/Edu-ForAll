<?php

namespace App\Controller;
use App\Entity\Cours;
use App\Entity\Test;
use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CourType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoursRepository;
use App\Repository\VideoRepository;
use App\Repository\TestRepository;

use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use App\Form\UserType;


use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\UserRepository;

class Test1Controller extends AbstractController
{
    /**
     * @Route("/test1", name="test1")
     */
    public function index(request $request , ManagerRegistry $doctrine ,UserInterface $user): Response
    {
        $entityManager = $doctrine->getManager();

        $task = new Cours();
      

        $form = $this->createForm(CourType::class, $task);



               $form->handleRequest($request);
        if ($form->isSubmitted()) {


//die($request->get("lien"));
          /*   $file=$request->files->get('lien');
             $filename=md5(uniqid()).'.'.$file->guessExtension();
             $file->move($this->getParameter('upload'),$filename);*/
           
              
         $file=$task->getLien();

             //$file=$form->get('video')->getData();
        //  var_dump($form->getData());die;
            //var_dump($form->getData()) ; 

               $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                $task->setLien($fileName);
                $id= $user->getId();
                 $task->setIdProf($id);
                 $entityManager->persist($task);
             $entityManager->flush();
             $test= new Test();
             $test->setNom("l'exame de ".$task->getNom());
             $test->setIdCour($task->getId());
             $file=$form->get('test')->getData();
                 $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                 $test->setLien($fileName);
                 

                 $entityManager->persist($test);
                        $entityManager->flush();



                         $video= new Video();
             $video->setNom("la video de cour de  ".$task->getNom());
             $video->setIdCour($task->getId());
             $file=$form->get('video')->getData();
                 $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                 $video->setLien($fileName);
                 $entityManager->persist($video);
                     $entityManager->flush();

            
                     return $this->redirectToRoute("liste_cour");
            
          }

        return $this->render('test1/index.html.twig', [
            'controller_name' => 'Test1Controller',   'form' =>  $form->createView(),
        ]);
    }

    /**
     * @Route("/test2", name="test2")
     */
    public function index2(request $request , ManagerRegistry $doctrine ,UserInterface $user): Response
    {
        $entityManager = $doctrine->getManager();

        $task = new Cours();
      

        $form = $this->createForm(CourType::class, $task);



               $form->handleRequest($request);
        if ($form->isSubmitted()) {


//die($request->get("lien"));
          /*   $file=$request->files->get('lien');
             $filename=md5(uniqid()).'.'.$file->guessExtension();
             $file->move($this->getParameter('upload'),$filename);*/
           
              
         $file=$task->getLien();

             //$file=$form->get('video')->getData();
        //  var_dump($form->getData());die;
            //var_dump($form->getData()) ; 

               $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                $task->setLien($fileName);
                $id= $user->getId();
                 $task->setIdProf($id);
                 $entityManager->persist($task);
             $entityManager->flush();
             $test= new Test();
             $test->setNom("l'exame de ".$task->getNom());
             $test->setIdCour($task->getId());
             $file=$form->get('test')->getData();
                 $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                 $test->setLien($fileName);
                 

                 $entityManager->persist($test);
                        $entityManager->flush();



                         $video= new Video();
             $video->setNom("la video de cour de  ".$task->getNom());
             $video->setIdCour($task->getId());
             $file=$form->get('video')->getData();
                 $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                 $video->setLien($fileName);
                 $entityManager->persist($video);
                     $entityManager->flush();

            
                     return $this->redirectToRoute("liste_cour_prof");
            
          }

        return $this->render('test1/ajouter.html.twig', [
            'controller_name' => 'Test1Controller',   'form' =>  $form->createView(),
        ]);
    }



       /**
     * @Route("/liste_cour", name="liste_cour")
     */
    public function liste(request $request , ManagerRegistry $doctrine , CoursRepository $courRepository, VideoRepository $videoRepository, TestRepository $testRepository): Response
    {
        $cours= $courRepository->findAll();
        $tests= $testRepository->findAll();
        $video= $videoRepository->findAll();
         return $this->render('test1/liste.html.twig' ,['cours' =>$cours , 'tests' =>$tests,  'videos' =>$video,]);
}

/**
     * @Route("/liste_cour_prof", name="liste_cour_prof")
     */
    public function liste_cour_prof(request $request ,UserInterface $user, ManagerRegistry $doctrine , CoursRepository $courRepository, VideoRepository $videoRepository, TestRepository $testRepository): Response
    {
        $cours= $courRepository->findBy(['id_prof'=>$user->getId()]);
        $tests= $testRepository->findAll();
        $video= $videoRepository->findAll();
         return $this->render('test1/liste1.html.twig' ,['cours' =>$cours , 'tests' =>$tests,  'videos' =>$video,]);
}
/**
     * @Route("/liste_prof", name="liste_prof")
     */
    public function liste_prof(request $request , ManagerRegistry $doctrine ,UserRepository $UserRepository, VideoRepository $videoRepository, TestRepository $testRepository): Response
    {
        $users= $UserRepository->findAll();
       
         return $this->render('test1/liste_profile.html.twig' ,['users' =>$users]);
}
/**
     * @Route("/delete_cour/{id}", name="delete_cour")
     */
    public function delete(request $request , ManagerRegistry $doctrine , CoursRepository $courRepository, VideoRepository $videoRepository, TestRepository $testRepository,$id): Response
    {
           $entityManager = $doctrine->getManager();
          $cours= $courRepository->find($id);
          $tests= $testRepository->findOneBy(['id_cour' => $id]);
         $video= $videoRepository->findOneBy(['id_cour' => $id]);
        $entityManager->remove($cours);
$entityManager->flush();
 $entityManager->remove($tests);
$entityManager->flush();
 $entityManager->remove($video);
$entityManager->flush();
         return $this->redirectToRoute("liste_cour");
}

/**
     * @Route("/profile", name="profile")
     */
    public function profile(request $request ,UserInterface $user,  ManagerRegistry $doctrine , UserRepository $userRepository, UserPasswordEncoderInterface $passewordEncoder): Response
    {
      // die( $user->getEmail() . $user->getId() );
        $id= $user->getId();
         $image= $user->getImage();
         $nom= $user->getNom()."  ".$user->getPrenom();

        $entityManager = $doctrine->getManager();
        $user= $userRepository->find($id);

      

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
            }else{
                $user->setImage($image);
            }
           
           // die($user->getImage());
               $role=[];
             //die($form->get('roles')->getData());
        /*$role[]=$form->get('roles')->getData();
        $user->setRoles($role);*/
           $passeword=$passewordEncoder->encodePassword($user,$user->getPassword()); 
        $user->setPassword($passeword);
         $entityManager->persist($user);
                 $entityManager->flush();
                return $this->redirectToRoute("liste_user");

                 }









        return $this->render('test1/profile.html.twig', [
            'controller_name' => 'HistoireController', 'form' =>  $form->createView(),"image"=>$image ,"nom"=>$nom , "user"=>$user
        ]);

    }



/**
     * @Route("/edit_cour", name="edit_cour")
     */
    public function edit(request $request , ManagerRegistry $doctrine , CoursRepository $courRepository, VideoRepository $videoRepository, TestRepository $testRepository): Response
    {
            
    $id=$request->get('id');

                $entityManager = $doctrine->getManager();
                $cour= $courRepository->find($id);
                 $tests= $testRepository->findOneBy(['id_cour' => $id]);
         $video= $videoRepository->findOneBy(['id_cour' => $id]);
                $lien_cour=$cour->getLien();
                 $lien_test=$tests->getLien();
                  $lien_video=$video->getLien();

      

        $form = $this->createForm(CourType::class, $cour);
       $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($cour->getLien()) {
                $file=$cour->getLien();
                $fileName=md5(uniqid()).'.'.$file->guessExtension();
               $file->move($this->getParameter('upload'), $fileName);
                $cour->setLien($fileName);
            }
            else{
                
                 $cour->setLien($lien_cour);
            }
         //   die($form->get('video')->getData());
          //  die($request->files->get('video'));
           // die($form->get('video')->getData() ==" ");
         if ($form->get('video')->getData()) {
          
               // $cour->setLien($lien_cour);
               //die($form->get('video')->getData());

             $file=$form->get('video')->getData();
                 $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                 $video->setLien($fileName);
                 $entityManager->persist($video);
                 $entityManager->flush();
            }else{
                $video->setLien($lien_video);
                $entityManager->persist($video);
                $entityManager->flush();

            }

               if ($form->get('test')->getData()) {
              

             $file=$form->get('test')->getData();
                 $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                 $tests->setLien($fileName);
                      $entityManager->persist($tests);
                 $entityManager->flush();
            }
            else{
                $tests->setLien($lien_test);
                $entityManager->persist($tests);
           $entityManager->flush();

            }
          
          
         $entityManager->persist($cour);
                 $entityManager->flush();
                return $this->redirectToRoute("liste_cour");

                 }
        return $this->render('test1/edite.html.twig', [
            'controller_name' => 'HistoireController', 'form' =>  $form->createView(),
        ]);
            return new response("hello");
}




/**
     * @Route("/profile2", name="profile2")
     */
    public function profile2(request $request ,  ManagerRegistry $doctrine , UserRepository $userRepository, UserPasswordEncoderInterface $passewordEncoder): Response
    {
      
        $id=$request->get("id");
        $user=$userRepository->find($id);



        return $this->render('test1/profile1.html.twig', [
            'controller_name' => 'HistoireController',"user"=>$user
        ]);

    }



    /**
     * @Route("/listecour", name="listecour")
     */
    public function listecour(request $request ,  ManagerRegistry $doctrine , CoursRepository $courRepository, UserPasswordEncoderInterface $passewordEncoder,VideoRepository $videoRepository, TestRepository $testRepository): Response
    {
      
        $id=$request->get("id");
        $cour=$courRepository->findBy(["id_prof"=>$id]);
        $video=$videoRepository->findAll();
        $test=$testRepository->findAll();



        return $this->render('test1/liste_cour.html.twig', [
            'controller_name' => 'HistoireController',"cours"=>$cour, "videos"
=>$video, "testes"=>$test        ]);

    }
}
