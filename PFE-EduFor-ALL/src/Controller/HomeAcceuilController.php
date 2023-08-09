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

class HomeAcceuilController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(HistoireRepository $histoireRepository): Response
    { $histoire=$histoireRepository->findAll();

        return $this->render('home_acceuil/index.html.twig', [
            'histoires' => $histoire,
        ]);
    }
}
