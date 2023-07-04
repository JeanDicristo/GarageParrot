<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Hourly;
use App\Entity\Image;
use App\Form\CarType;
use App\Repository\CarRepository;
use App\Repository\HourlyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
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

    
    // Function New
     #[Route('/nouveau', name: 'newCar')]
    public function new(
        ManagerRegistry $doctrine,
        HttpFoundationRequest $request, 
        HourlyRepository $hourlyRepository,
        EntityManagerInterface $manager,
        UploaderHelper $uploaderHelper
    ) : Response {

         // Import Entity Hourly via the repository
         $hourlyRepository = $doctrine->getRepository(Hourly::class);
         $hourlys = $hourlyRepository->findBy([]);

         $car = new Car();
         $form = $this->createForm(CarType::class, $car);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
        
            foreach ($car->getImageFile() as $uploadedFile) {
                $image = new Image();
                $imageName = $uploaderHelper->asset($car, 'imageFile');
                $image->setImageName($imageName);
            
                // ...
            
                $image->setCar($car);
                $manager->persist($image);
                $car->addImage($image);
            }
            
            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre voiture à bien étais pris en compte'
            );

            return $this->redirectToRoute('car');
         }

        return $this->render('pages/car/new.html.twig', [
            'carForm' => $form->createView(),
            'hourlys' => $hourlys,
        ]);
    }
    

    // Function Edit
     #[Route('/occasion/edition/{id}', name: 'editCar', methods: ['GET', 'POST'])]
    public function edit(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        HttpFoundationRequest $request, 
        EntityManagerInterface $manager
        ) : Response {

         // Import Entity Hourly via the repository
        $hourlyRepository = $doctrine->getRepository(Hourly::class);
        $hourlys = $hourlyRepository->findBy([]);

        $car = new Car();
         $form = $this->createForm(CarType::class, $car);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();
            
            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre voiture à bien étais modifier'
            );

            return $this->redirectToRoute('index');
         }

        return $this->render('pages/car/edit.html.twig', [
            'carForm' => $form->createView(),
            'hourlys' => $hourlys,
        ]);
    }


    // Function Delete
     #[Route('/occasion/supprimer/{id}', name: 'deleteCar', methods: ['GET'])]
    public function delete(
        EntityManagerInterface $manager,
        Car $car
        ) : Response {

        $manager->remove($car);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre offre a été supprimé avec succès !'
        );

        return $this->redirectToRoute('occasion');
        
    }
}
