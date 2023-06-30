<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarDetailController extends AbstractController
{
    #[Route('/car/detail', name: 'car_detail')]
    public function index(): Response
    {
        // Import Entity Hourly via the repository

         // Import Entity Brand via the repository

         // Import Entity Car via the repository

        //  if (!$car) {
        //     throw $this->createNotFoundException('Voiture introuvable');
        //  }

        return $this->render('pages/car_detail/detail.html.twig', [
        ]);
    }
}
