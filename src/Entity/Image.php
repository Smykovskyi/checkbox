<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ORM\Table(name: "images")]
#[ApiResource(    operations: [
    new Post(),
    new Get(),
    new GetCollection(),
    new Put()
    ],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
    paginationItemsPerPage: 10,
    formats: ['json', 'jsonld']
)]
class Image
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


    #[ORM\Column(type: 'string', name: "extension", length: 50)]
    #[Groups(['read', 'write'])]
    private ?string $extension = null;

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        if('jpg' == $extension or 'png' == $extension) {
            $this->extension = $extension;

            return $this;
        }

        die('File size is bigger than 2 mb. Download smaller file.');
    }


    #[ORM\Column(type: 'integer', name: "size")]
    #[Groups(['read', 'write'])]
    private ?int $size = null;

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        if (filesize($size) <= 2000000) {
            $this->size = $size;

            return $this;
        }

        die('File size is bigger than 2 mb. Download smaller file.');
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


    #[ORM\Column(type: 'string', name: "path", length: 500)]
    #[Groups(['read', 'write'])]
    private ?string $path = null;

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

}
