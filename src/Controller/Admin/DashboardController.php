<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('V.Parrot - Administation')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
         yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         //CAR <i class="fa-solid fa-car"></i>
         //Contact <i class="fa-solid fa-address-card"></i>
    }
}
