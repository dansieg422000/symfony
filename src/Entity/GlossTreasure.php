<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\GlossTreasureRepository;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\SerializedName;

#[ORM\Entity(repositoryClass: GlossTreasureRepository::class)]
#[ApiResource(
    shortName: 'Treasure',
    description: 'Gloss treasure',
    operations: [
//        new Get(uriTemplate: '/gloss-treasure/{treasureId}'),
//        new GetCollection(uriTemplate: 'gloss-treasure'),
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete()
    ],
    normalizationContext: ['groups' => ['glossTreasure:read']],
    denormalizationContext: ['groups' => ['glossTreasure:write']],
    paginationItemsPerPage: 5
)]
class GlossTreasure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    private int $glossValue = 0;

    #[ORM\Column]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    #[SerializedName('createdDate')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    private ?bool $isPublished = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    #[Groups(['glossTreasure:read'])]
    public function getGlossValue(): ?int
    {
        return $this->glossValue;
    }

    #[Groups('glossTreasure:write')]
    public function setGlossValue(int $glossValue): static
    {
        $this->glossValue = $glossValue;

        return $this;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * A human-readable Date for CreatedAt property.
     */
    #[Groups(['glossTreasure:read'])]
    public function getCreatedAtAgo(): string
    {
        return Carbon::instance($this->createdAt)->diffForHumans();
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    #[Groups('glossTreasure:write')]
    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
