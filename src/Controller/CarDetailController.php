<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Contact;
use App\Entity\Hourly;
use App\Entity\Image;
use App\Form\ContactType;
use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use App\Repository\HourlyRepository;
use App\Repository\ImageRepository;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class CarDetailController extends AbstractController
{
    #[Route('car/detail/{id}', name: 'car_detail', methods: 'GET')]
    public function index(
        ManagerRegistry $doctrine,
        HourlyRepository $hourlyRepository,
        BrandRepository $brandRepository,
        HttpFoundationRequest $request, 
        EntityManagerInterface $manager,
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

        $contact = (new Contact())->setName($car->getName());

        // Récupérer l'instance du formulaire de contact (ContactType)
        $form = $this->createForm(ContactType::class, $contact);

        // Traiter la soumission du formulaire de contact s'il est envoyé
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message à bien étais envoyer'
            );

            return $this->redirectToRoute('index');
        }

        return $this->render('pages/car_detail/detail.html.twig', [
            'hourlys' => $hourlys,
            'brands' => $brands,
            'car' => $car,
            'form' => $form->createView(), // Ajoutez la variable 'form' dans le tableau contextuel
        ]);
    }

}