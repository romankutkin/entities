<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;

/**
 * @ORM\Entity
 * @ORM\Table(name="stacks")
 */
class Stack
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
     * 
     * @var string|null
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * 
     * @var string|null
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * 
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * 
     * @var \DateTime|null
     */
    private $updatedAt;

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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * 
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * 
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
