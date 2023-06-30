<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Repository\HourlyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
    ): Response
    {
        // Import Entity Hourly via the repository
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBy([]);

        // Import Entity Service via the repository
        $serviceRepository = $doctrine->getRepository(Service::class);
        $services = $serviceRepository->findBy([]);


        return $this->render('pages/home/index.html.twig', [
           'hourlys' => $hourlys,
           'services' => $services,
        ]);
    }
}
