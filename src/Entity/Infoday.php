<?php

namespace App\Entity;

use App\Repository\InfodayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

***REMOVED***[ORM\Entity(repositoryClass: InfodayRepository::class)]
class Infoday
{
    ***REMOVED***[ORM\Id]
    ***REMOVED***[ORM\GeneratedValue]
    ***REMOVED***[ORM\Column]
    private ?int $id = null;

    ***REMOVED***[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    ***REMOVED***[ORM\OneToMany(mappedBy: 'infoday', targetEntity: User::class)]
    private Collection $users;

    /****REMOVED***[ORM\OneToMany(mappedBy: 'datevisited', targetEntity: Feedback::class)]
    private Collection $feedback;*/

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setInfoday($this);
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->date->format('d-m-Y');
    }

    public function setId(int $int) : static
    {
        $this->id = $int;
        return $this;
    }
}