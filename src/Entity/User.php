<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ApiResource(
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']],
)]
#[UniqueEntity(fields: ['email'], message: 'This email is already taken.')]
#[UniqueEntity(fields: ['username'], message: 'This username is already taken.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Groups(['user:read', 'user:write'])]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    #[Groups(['user:read', 'user:write'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['user:write'])]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(8)]
    private ?string $password = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['user:read', 'user:write', 'glossTreasure:read'])]
    #[Assert\NotBlank]
    #[Assert\Length(min: 8, max: 20)]
    private ?string $username = null;

    /**
     * @var Collection<int, GlossTreasure>
     */
    #[ORM\OneToMany(targetEntity: GlossTreasure::class, mappedBy: 'owner')]
    #[Groups(['user:read'])]
    private Collection $glossTreasures;

    public function __construct()
    {
        $this->glossTreasures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, GlossTreasure>
     */
    public function getGlossTreasures(): Collection
    {
        return $this->glossTreasures;
    }

    public function addGlossTreasure(GlossTreasure $glossTreasure): static
    {
        if (!$this->glossTreasures->contains($glossTreasure)) {
            $this->glossTreasures->add($glossTreasure);
            $glossTreasure->setOwner($this);
        }

        return $this;
    }

    public function removeGlossTreasure(GlossTreasure $glossTreasure): static
    {
        if ($this->glossTreasures->removeElement($glossTreasure)) {
            // set the owning side to null (unless already changed)
            if ($glossTreasure->getOwner() === $this) {
                $glossTreasure->setOwner(null);
            }
        }

        return $this;
    }
}
