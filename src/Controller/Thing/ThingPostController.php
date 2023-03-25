<?php

namespace App\Controller\Thing;

use App\Entity\Thing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class ThingPostController extends AbstractController
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $thing = new Thing\Thing();

        $thing->setName($data['name']);
        $thing->setColor($data['color']);

        $entityManager->persist($thing);
        $entityManager->flush();

        return $this->json([
            'message' => 'Thing created successfully',
            'thing' => $thing,
        ]);
    }
}