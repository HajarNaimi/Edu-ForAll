<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ArticleRepository;
use App\Entity\Article;
class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(request $request , ManagerRegistry $doctrine): Response
    {  
            $entityManager = $doctrine->getManager();
        if (isset($_POST['ok'])) {
         //   print_r($request->query->get('title'));die;
            $article= new Article();
        $file=$request->files->get('image');
             $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                      $article->setImage($fileName);
                      $article->setTitre($request->get('titre'));
                      //die($request->get('editor1'));
                      $article->setArticle($request->get('editor1'));
                         $entityManager->persist($article);
                 $entityManager->flush();
                 return $this->redirectToRoute("liste_article");
   //return new response($request->files->get('image'));
        }
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }






       /**
     * @Route("/liste_article", name="liste_article")
     */
    public function liste(request $request , ManagerRegistry $doctrine , ArticleRepository $articleRepository): Response
    {
        $article= $articleRepository->findAll();
         return $this->render('article/list.html.twig' ,['articles' =>$article]);
}
/**
     * @Route("/article1", name="article1")
     */
    public function liste1(request $request , ManagerRegistry $doctrine , ArticleRepository $articleRepository): Response
    {
        $article= $articleRepository->findAll();
         return $this->render('testarticle/article.html.twig' ,['articles' =>$article]);
}

/**
     * @Route("/article2", name="article2")
     */
    public function liste2(request $request , ManagerRegistry $doctrine , ArticleRepository $articleRepository): Response
    {$id=$request->get("id");
        $article= $articleRepository->find($id);
         return $this->render('testarticle/lirearticle.html.twig' ,['article' =>$article]);
}

/**
     * @Route("/delete_article/{id}", name="delete_article")
     */
    public function delete(request $request , ManagerRegistry $doctrine , ArticleRepository $articleRepository,$id): Response
    {
           $entityManager = $doctrine->getManager();
          $article= $articleRepository->find($id);
        $entityManager->remove($article);
$entityManager->flush();
         return $this->redirectToRoute("liste_article");
}



/**
     * @Route("/edit_article", name="edit_article")
     */
    public function edit(request $request , ManagerRegistry $doctrine ,ArticleRepository $articleRepository )
    {
     $id=$request->get("id");
           $entityManager = $doctrine->getManager();
         $article= $articleRepository->find($id);
 if (isset($_POST['ok1'])) {

              // return new Response($request->files->get('image'));
          if ($request->files->get('image')) {
              $file=$request->files->get('image');
             $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload'), $fileName);
                $article->setImage($fileName);
               
          }
                  $article->setTitre($request->get('titre'));
                      //die($request->get('editor1'));
                      $article->setArticle($request->get('editor1'));
                         $entityManager->persist($article);
                 $entityManager->flush();
                    return $this->redirectToRoute("liste_article");

      }
              
        return $this->render('article/modifier.html.twig' ,["article"=>$article]);
}

}
