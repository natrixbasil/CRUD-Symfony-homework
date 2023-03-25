<?php

namespace App\Entity\Thing;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Thing\ThingDeleteController;
use App\Controller\Thing\ThingGetCollectionController;
use App\Controller\Thing\ThingGetItemController;
use App\Controller\Thing\ThingPatchController;
use App\Controller\Thing\ThingPostController;
use App\Controller\Thing\ThingPutController;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource(
    operations:
    [
        new Post(
            uriTemplate:'/thing',
            controller: ThingPostController::class,
            name:'CreateANewThing'),
        new Get(
            uriTemplate:'/thing/{id}', // /things/{id}/reset-password?hash=
            controller: ThingGetItemController::class,
            name:'GetInfoAboutOneThing'),
        new GetCollection(
            uriTemplate:'/thing',
            controller: ThingGetCollectionController::class,
            name:'GetCollectionOfThings'),
        new Put(
            uriTemplate:'/thing/{id}',
            controller: ThingPutController::class,
            name:'ReplaceAThing'),
        new Patch(
            uriTemplate:'/thing/{id}',
            controller: ThingPatchController::class,
            name:'UpdateAThing'),
        new Delete(
            uriTemplate:'/thing/{id}',
            controller: ThingDeleteController::class,
            name:'DeleteAThing')
    ])]

class Thing
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $Id = null;

    #[ORM\Column(type: "string",length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "text")]
    private ?string $color = null;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->Id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string // чтение
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void // изменение
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

}