<?php

namespace App\Entity;

use App\Service\Database\TimestampTrait;
use App\Service\Database\UidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stacks")
 * @ORM\HasLifecycleCallbacks
 */
class Stack
{
    use UidTrait, TimestampTrait;

    /**
     * @ORM\Column(type="string", nullable=false)
     * 
     * @var string|null
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=Flashcard::class, inversedBy="stacks")
     * @ORM\JoinTable(name="stack_flashcards")
     * 
     * @var Collection|null
     */
    private $flashcards;

    public function __construct()
    {
        $this->flashcards = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * 
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getFlashcards(): Collection
    {
        return $this->flashcards;
    }

    /**
     * @param Flashcard $flashcard
     * 
     * @return self
     */
    public function addFlashcard(Flashcard $flashcard): self
    {
        if (!$this->flashcards->contains($flashcard)) {
            $this->flashcards[] = $flashcard;
        }

        return $this;
    }

    /**
     * @param Flashcard $flashcard
     * 
     * @return self
     */
    public function removeFlashcard(Flashcard $flashcard): self
    {
        $this->flashcards->removeElement($flashcard);

        return $this;
    }
}
