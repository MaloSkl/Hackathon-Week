<?php

namespace App\Controller\Admin;

use App\Entity\Agency;
use App\Entity\Employee;
use App\Entity\Job;
use App\Entity\Team;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator =$this->container->get(AdminUrlGenerator::class);
        $url = $adminUrlGenerator->setController(EmployeeCrudController::class)->generateUrl();

        return $this->redirect($url);

        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin');
    }

    public function configureMenuItems(): iterable
    {
        //https://fontawesome.com/search?q=home&o=r&c=humanitarian
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Employé(e)', 'fa-solid fa-person', Employee::class);
        yield MenuItem::linkToCrud('Poste', 'fa-solid fa-clipboard-user', Job::class);
        yield MenuItem::linkToCrud('Equipe', 'fa-solid fa-people-group', Team::class);
        yield MenuItem::linkToCrud('Agence', 'fa-solid fa-house-flag', Agency::class);
    }
}
