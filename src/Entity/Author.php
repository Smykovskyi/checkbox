<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Post(),
        new GetCollection(),
    ],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
    paginationItemsPerPage: 10,
    formats: ['json', 'jsonld']
)]
#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ORM\Table(name: "authors")]

class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer', name: "id")]
    #[Groups(['read'])]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    #[ORM\Column(type: 'string', name: "surname", length: 255)]
    #[Assert\GreaterThan(3)]
    #[Groups(['read', 'write'])]
    private ?string $surname = null;

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }


    #[ORM\Column(type: 'string', name: "name", length: 255)]
    #[Groups(['read', 'write'])]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }


    #[ORM\Column(type: 'string', name: "patronymic", length: 255, nullable: true)]
    #[Groups(['read', 'write'])]
    private ?string $patronymic = null;

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): static
    {
        $this->patronymic = $patronymic;

        return $this;
    }

}
