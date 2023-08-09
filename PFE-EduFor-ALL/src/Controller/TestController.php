<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ArticleRepository;


class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(Request $request): Response
    {
 
//         if(isset($_POST['ok'])){

// //die($request->get("lien"));
//           /*   $file=$request->files->get('lien');
//              $filename=md5(uniqid()).'.'.$file->guessExtension();
//              $file->move($this->getParameter('upload'),$filename);*/
           
              
//          $file=$request->query->get('image');
//         //  var_dump($form->getData());die;
//             //var_dump($form->getData()) ; 

//                $fileName=md5(uniqid()).'.'.$file->guessExtension();
//                 $file->move($this->getParameter('upload_directory'), $fileName);

            
//             return new response("hello");
            
//           }

      //  $form->get('contacts')->getData() 
        return $this->render('testarticle/article.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

}
