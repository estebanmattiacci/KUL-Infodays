<?php

namespace App\Entity;

use App\Repository\InterestsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

***REMOVED***[ORM\Entity(repositoryClass: InterestsRepository::class)]
class Interest
{
    ***REMOVED***[ORM\Id]
    ***REMOVED***[ORM\GeneratedValue]
    ***REMOVED***[ORM\Column]
    private ?int $id = null;

    ***REMOVED***[ORM\Column]
    private ?string $name = null;
    ***REMOVED***[ORM\ManyToMany(targetEntity: Feedback::class, inversedBy: 'interests')]
    private Collection $feedbacks;

    public function __construct()
    {
        $this->feedbacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedbacks(): Collection
    {
        return $this->feedbacks;
    }

    public function addFeedback(Feedback $feedback): static
    {
        if (!$this->feedbacks->contains($feedback)) {
            $this->feedbacks->add($feedback);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): static
    {
        $this->feedbacks->removeElement($feedback);

        return $this;
    }

    public function setName(string $name) : static
    {
        $this->name = $name;
        return $this;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setId(int $int) : static
    {
        $this->id = $int;
        return $this;
    }
}
