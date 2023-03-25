<?php

namespace App\Controller\Thing;
use App\Entity\Thing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ThingGetItemController extends AbstractController
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Thing\Thing $thing, int $id): JsonResponse
    {
        $thing = $this->entityManager->getRepository(Thing\Thing::class)->find($id);

        if (!$thing) {
            throw $this->createNotFoundException('Thing not found');
        }
        return $this->json($thing);
    }
}
