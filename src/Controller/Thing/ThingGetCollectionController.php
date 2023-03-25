<?php

namespace App\Controller\Thing;

use App\Entity\Thing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ThingGetCollectionController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function __invoke(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $things = $this->entityManager->getRepository(Thing\Thing::class)->findAll();
        return $this->json($things);
    }
}