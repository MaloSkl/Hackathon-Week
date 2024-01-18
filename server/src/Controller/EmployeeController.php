<?php

namespace App\Controller;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EmployeeController extends AbstractController
{
    #[Route('/init', name: 'init')]
    public function init(HttpClientInterface $httpClient, EntityManagerInterface $entityManager): Response
    {
        $response = $httpClient->request(
            'GET',
            'https://trombi.6tmphp.fr/data.json'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $content = $response->toArray();

        foreach ($content as $elem) {
            $employee = new Employee();
            $employee->setFirstName($elem["prenom"]);
            $employee->setLastName($elem["nom"]);
            $employee->setJob($elem["poste"]);
            $employee->setTeam($elem["equipe"]);
            $employee->setOffice($elem["agence"]);

            if (array_key_exists("photo_pro", $elem)) {
                $employee->setProPhoto($elem["photo_pro"]);
            } else {
                $employee->setProPhoto("");
            }

            if (array_key_exists("photo_fun", $elem)) {
                $employee->setFunPhoto($elem["photo_fun"]);
            } else {
                $employee->setFunPhoto("");
            }

            $entityManager->persist($employee);

            $entityManager->flush();
        }
        
        return new Response(json_encode($content));
    }

    #[Route('/create-employee', name: 'create_employee')]
    public function createEmployee(EntityManagerInterface $entityManager, Request $request): Response
    {
        $postData = $request->request->all();

        $employee = new Employee();
        $employee->setFirstName($postData["firstName"]);
        $employee->setLastName($postData["lastName"]);
        $employee->setJob($postData["job"]);
        $employee->setTeam($postData["team"]);
        $employee->setOffice($postData["office"]);
        $employee->setProPhoto($postData["proPhoto"]);
        $employee->setFunPhoto($postData["funPhoto"]);

        $entityManager->persist($employee);

        $entityManager->flush();

        return new Response('Saved new product with id '.$employee->getId());
    }

    #[Route('/get-employee/{id}', name: 'get_employee')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $employee = $entityManager->getRepository(Employee::class)->find($id);

        if (!$employee) {
            throw $this->createNotFoundException(
                'No employee found for id '.$id
            );
        }

        $data = [
            'employee' => [
                'id' => $employee->getId(),
                'firstName' => $employee->getFirstName(),
                'lastName' => $employee->getLastName(),
                'job' => $employee->getJob(),
                'team' => $employee->getTeam(),
                'pro_photo' => $employee->getProPhoto(),
                'fun_photo' => $employee->getFunPhoto()
            ],
        ];

        return new JsonResponse($data);
    }

    #[Route('/get-all', name: 'get-all')]
    public function fetchEntries(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Employee::class);

        $entries = $repository->findAll();

        $serializer = $this->container->get('serializer');
        $versionJSON = $serializer->serialize($entries, 'json');

        return new Response($versionJSON);
    }
}
