<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Serializer\Filter\PropertyFilter;
use App\Repository\GlossTreasureRepository;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\String\u;

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
    formats: ['json', 'jsonld', 'html', 'csv' => 'text/csv'],
    normalizationContext: ['groups' => ['glossTreasure:read']],
    denormalizationContext: ['groups' => ['glossTreasure:write']],
    paginationItemsPerPage: 5
)]
#[ApiFilter(PropertyFilter::class)]
class GlossTreasure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 255, maxMessage: 'Name is required at least 2 characters')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    #[ApiFilter(RangeFilter::class)]
    #[Assert\GreaterThanOrEqual(0)]
    private int $glossValue = 0;

    #[ORM\Column]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    #[SerializedName('createdDate')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    #[Groups(['glossTreasure:read', 'glossTreasure:write'])]
    #[ApiFilter(BooleanFilter::class)]
    private ?bool $isPublished = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['glossTreasure:read'])]
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    #[Groups(['glossTreasure:read'])]
    public function getDescription(): ?string
    {
        return $this->description;
    }

    #[Groups(['glossTreasure:read'])]
    public function getShortDescription(): ?string
    {
        return u($this->description)->truncate(40, '...');
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
