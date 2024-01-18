<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Agency;
use App\Entity\Job;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EmployeeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/init', name: 'init')]
    public function init(HttpClientInterface $httpClient): Response
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
            $agency = $this->addAndGetAgency($elem["agence"]);
            $job = $this->addAndGetJob($elem["poste"]);
            $team = $this->addAndGetTeam($elem["equipe"]);

            $employee = new Employee();
            $employee->setAgency($agency);
            $employee->setJob($job);
            $employee->setTeam($team);
            $employee->setName($elem["nom"]);
            $employee->setFirstName($elem["prenom"]);
            if (array_key_exists("photo_pro", $elem))
                $employee->setPicturePro($elem["photo_pro"]);
            if (array_key_exists("photo_fun", $elem))
                $employee->setPictureFun($elem["photo_fun"]);

            $this->entityManager->persist($employee);
            $this->entityManager->flush();
        }

        return new Response("Successfully init database");
    }

    private function addAndGetAgency($agencyName)
    {
        $extistingAgency = $this->entityManager->getRepository(Agency::class)->findOneBy(array('name' => $agencyName));

        if ($extistingAgency)
            return $extistingAgency;

        $newAgency = new Agency();
        $newAgency->setName($agencyName);
        $this->entityManager->persist($newAgency);
        $this->entityManager->flush();

        return $this->entityManager->getRepository(Agency::class)->findOneBy(array('name' => $agencyName));
    }

    private function addAndGetJob($jobName)
    {
        $extistingJob = $this->entityManager->getRepository(Job::class)->findOneBy(array('name' => $jobName));

        if ($extistingJob)
            return $extistingJob;

        $newJob = new Job();
        $newJob->setName($jobName);
        $this->entityManager->persist($newJob);
        $this->entityManager->flush();

        return $this->entityManager->getRepository(Job::class)->findOneBy(array('name' => $jobName));
    }

    private function addAndGetTeam($teamName)
    {
        $extistingTeam = $this->entityManager->getRepository(Team::class)->findOneBy(array('name' => $teamName));

        if ($extistingTeam)
            return $extistingTeam;

        $newTeam = new Team();
        $newTeam->setName($teamName);
        $this->entityManager->persist($newTeam);
        $this->entityManager->flush();

        return $this->entityManager->getRepository(Team::class)->findOneBy(array('name' => $teamName));
    }

    // #[Route('/create-employee', name: 'create_employee')]
    // public function createEmployee(EntityManagerInterface $entityManager, Request $request): Response
    // {
    //     $postData = $request->request->all();

    //     $employee = new Employee();
    //     $employee->setFirstName($postData["firstName"]);
    //     $employee->setLastName($postData["lastName"]);
    //     $employee->setJob($postData["job"]);
    //     $employee->setTeam($postData["team"]);
    //     $employee->setOffice($postData["office"]);
    //     $employee->setProPhoto($postData["proPhoto"]);
    //     $employee->setFunPhoto($postData["funPhoto"]);

    //     $entityManager->persist($employee);

    //     $entityManager->flush();

    //     return new Response('Saved new product with id '.$employee->getId());
    // }

    // #[Route('/get-employee/{id}', name: 'get_employee')]
    // public function show(EntityManagerInterface $entityManager, int $id): Response
    // {
    //     $employee = $entityManager->getRepository(Employee::class)->find($id);

    //     if (!$employee) {
    //         throw $this->createNotFoundException(
    //             'No employee found for id '.$id
    //         );
    //     }

    //     $data = [
    //         'employee' => [
    //             'id' => $employee->getId(),
    //             'firstName' => $employee->getFirstName(),
    //             'lastName' => $employee->getLastName(),
    //             'job' => $employee->getJob(),
    //             'team' => $employee->getTeam(),
    //             'pro_photo' => $employee->getProPhoto(),
    //             'fun_photo' => $employee->getFunPhoto()
    //         ],
    //     ];

    //     return new JsonResponse($data);
    // }

    #[Route('/get-all', name: 'get-all')]
    public function fetchEntries(): Response
    {
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $data = [];
        $repository = $this->entityManager->getRepository(Employee::class);

        $entries = $repository->findAll();

        foreach ($entries as $entry) {
            $data[] = [
                "name" => $entry->getName(),
                "firstName" => $entry->getFirstName(),
                "job" => $entry->getJob()->getName(),
                "agency" => $entry->getAgency()->getName(),
                "team" => $entry->getTeam()->getName(),
                "picturePro" => $entry->getPicturePro(),
                "pictureFun" => $entry->getPictureFun()
            ];
        }

        $response->setContent(json_encode($data));
        return $response;
        // return new Response(json_encode($data));
    }
}
