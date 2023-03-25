<?php

namespace App\Controller\Thing;

use App\Entity\Thing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
class ThingPatchController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, Thing\Thing $thing, $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $thing->setName($data['name']);}

        if (isset($data['color'])) {
            $thing->setColor($data['color']);}

        $this->$entityManager->persist($thing);
        $this->$entityManager->flush();

        return $this->json([
            'message' => 'Thing updated successfully',
            'thing' => $thing,
        ]);
    }
}