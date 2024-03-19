<?php

namespace App\Entity;

use App\Repository\FeedbackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints\DateTime;

***REMOVED***[ORM\Entity(repositoryClass: FeedbackRepository::class)]
class Feedback
{
    ***REMOVED***[ORM\Id]
    ***REMOVED***[ORM\GeneratedValue]
    ***REMOVED***[ORM\Column]
    private ?int $id = null;

    /****REMOVED***[ORM\ManyToOne(targetEntity: Infoday::class, inversedBy: 'feedback'),ORM\JoinColumn(nullable: false)]
    private $datevisited = null;*/

    ***REMOVED***[ORM\Column]
    private ?int $rating = null;

    ***REMOVED***[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    ***REMOVED***[ORM\ManyToMany(targetEntity: Interest::class, mappedBy: 'feedbacks')]
    private Collection $interests;

    ***REMOVED***[ORM\OneToOne(inversedBy: 'feedback', targetEntity: User::class)]
    ***REMOVED***[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    public function __construct()
    {
        $this->interests = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /*public function getDatevisited(): ?Infoday
    {
        return $this->datevisited;
    }

    public function setDatevisited(?Infoday $datevisited): static
    {
        $this->datevisited = $datevisited;

        return $this;
    }*/

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }



    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function setId(int $int): static
    {
        $this->id = $int;

        return $this;
    }

    /**
     * @return Collection<Interest>
     */
    public function getInterests(): Collection
    {
        return $this->interests;
    }

    public function addInterest(Interest $interest): static
    {
        if (!$this->interests->contains($interest)) {
            $this->interests->add($interest);
            $interest->addFeedback($this);
        }

        return $this;
    }

    public function removeInterest(Interest $interest): static
    {
        if ($this->interests->removeElement($interest)) {
            $interest->removeFeedback($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }


}
