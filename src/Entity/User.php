<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

***REMOVED***[ORM\Entity(repositoryClass: UserRepository::class)]
***REMOVED***[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    ***REMOVED***[ORM\Id]
    ***REMOVED***[ORM\GeneratedValue]
    ***REMOVED***[ORM\Column]
    private ?int $id = null;

    ***REMOVED***[ORM\Column(length: 180)]
    private ?string $username = null;

    ***REMOVED***[ORM\Column]
    private array $roles = [];

    /**
     * @var ?string The hashed password
     */
    ***REMOVED***[ORM\Column]
    private ?string $password = null;

    ***REMOVED***[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    ***REMOVED***[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    ***REMOVED***[ORM\Column(length: 180)]
    private ?string $firstname = null;

    ***REMOVED***[ORM\Column(length: 180)]
    private ?string $lastname = null;

    ***REMOVED***[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    ***REMOVED***[ORM\ManyToOne(targetEntity: Infoday::class, inversedBy: 'users')]
    private  Infoday $infoday;

    ***REMOVED***[ORM\OneToOne(mappedBy: 'user', targetEntity: Feedback::class)]
    private ?Feedback $feedback = null;

    public function getId(): ?int
    {
        return $this->id;
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
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        //$roles[] = 'ROLE_USER, ROLE_ADMIN';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getInfoday(): ?Infoday
    {
        return $this->infoday;
    }

    public function setInfoday(?Infoday $infoday): static
    {
        $this->infoday = $infoday;

        return $this;
    }

    public function getFeedback(): ?Feedback
    {
        return $this->feedback;
    }

    public function setFeedback(?Feedback $feedback): static
    {
        $this->feedback = $feedback;

        return $this;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }


}