<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Hourly;
use App\Entity\Image;
use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use App\Repository\HourlyRepository;
use App\Repository\ImageRepository;
use App\Repository\PhotoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarDetailController extends AbstractController
{
    #[Route('car/detail/{id}', name: 'car_detail', methods: 'GET')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        BrandRepository $brandRepository,
        ImageRepository $imageRepository,
        CarRepository $carRepository,
        int $id
    ): Response {
        // Import Entity Hourly via the repository
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBy([]);

        // Import Entity Brand via the repository
        $brandRepository = $doctrine->getRepository(Brand::class);
        $brands = $brandRepository->findBy([]);

        // Import Entity Car via the repository
        $carRepository = $doctrine->getRepository(Car::class);
        $car = $carRepository->find($id);

        if (!$car) {
            throw new NotFoundHttpException('Voiture introuvable');
        }

        // Import Entity Car via the repository
        $imageRepository = $doctrine->getRepository(Image::class);
        $images = $imageRepository->findBy(['car' => $car]);

        return $this->render('pages/car_detail/detail.html.twig', [
            'hourlys' => $hourlys,
            'brands' => $brands,
            'car' => $car,
            'images' => $images,
        ]);
    }
}
