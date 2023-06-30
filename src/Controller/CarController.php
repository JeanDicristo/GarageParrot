<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Hourly;
use App\Repository\CarRepository;
use App\Repository\HourlyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/occasion', name: 'car')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        CarRepository $carRepository,
    ): Response
    {
        // Import Entity Hourly via the repository
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBy([]);

        // Import Entity Car via the repository
        $carRepository = $doctrine->getRepository(Car::class);
        $cars = $carRepository->findBy([]);

        return $this->render('pages/car/car.html.twig', [
            'hourlys' => $hourlys,
            'cars' => $cars,
        ]);
    }
}
