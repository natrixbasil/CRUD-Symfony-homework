<?php

namespace App\Controller\Thing;

use App\Entity\Thing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class ThingPutController extends AbstractController
{   private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, Thing\Thing $thing, EntityManagerInterface $entityManager): JsonResponse
    {   $data = json_decode($request->getContent(), true);

        $thing->setName($data['name']);
        $thing->setColor($data['color']);

        $this->entityManager->persist($thing);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Thing updated successfully',
            'thing' => $thing,
        ]);
    }
}