<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;

#[ApiResource(
    operations: [
        new Post(),
        new Get(),
        new GetCollection(),
        new Put(),
    ],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
    paginationItemsPerPage: 10,
    formats: ['json', 'jsonld']
)]
#[ApiFilter(SearchFilter::class, properties: ['author.surname' => 'partial'])]
#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Table(name: "books")]

class Book
{

    public function __construct()
    {
        $this->author = new ArrayCollection();
    }


    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer', name: "id")]
    #[Groups(['read'])]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    #[ORM\Column(type: 'string', name: "title", length: 255)]
    #[Groups(['read', 'write'])]
    private ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }


    #[ORM\Column(type: 'string', length: 600, nullable: true, name: "description")]
    #[Groups(['read', 'write'])]
    private ?string $description = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }


    #[ORM\Column(type: Types::DATETIME_MUTABLE, name: "publicated_at")]
    #[Groups(['read', 'write'])]
    private ?\DateTimeInterface $publicationDate = null;

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): static
    {
        $this->publicationDate = $publication_date;

        return $this;
    }


    // One Book have many Authors
    // One-To-Many, Unidirectional with Join Table
    #[ORM\JoinTable(name: 'books_authors')]
    #[ORM\ManyToMany(targetEntity: Author::class)]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id', nullable: false)]
    #[ORM\InverseJoinColumn(name: 'author_id', referencedColumnName: 'id', unique: true)]
    #[Groups(['read', 'write'])]
    private Collection $author;

    /**
     * @param ArrayCollection|Collection $author
     */
    public function setAuthor(ArrayCollection|Collection $author): void
    {
        $this->author = $author;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getAuthor(): ArrayCollection|Collection
    {
        return $this->author;
    }

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: true)]
    private ?Image $image = null;

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

}
