<?php

namespace App\Entity;

use App\Service\Database\TimestampTrait;
use App\Service\Database\UidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks
 */
class User
{
    use UidTrait, TimestampTrait;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     * 
     * @var string|null
     */
    private $username;

    /**
     * @ORM\Column(type="string", nullable=false)
     * 
     * @var string|null
     */
    private $password;

    /**
     * @ORM\Column(type="string", nullable=true)
     * 
     * @var string|null
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * 
     * @var string|null
     */
    private $lastName;
    
    /**
     * @ORM\OneToMany(targetEntity=Stack::class, mappedBy="author")
     *
     * @var Collection|null
     */
    private $stacks;

    /**
     * @ORM\OneToMany(targetEntity=Flashcard::class, mappedBy="author")
     *
     * @var Collection|null
     */
    private $flashcards;

    public function __construct()
    {
        $this->stacks = new ArrayCollection();
        $this->flashcards = new ArrayCollection();
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        
        return $this;
    }

    /**
     * @return Collection
     */
    public function getStacks(): Collection
    {
        return $this->stacks;
    }

    /**
     * @param Stack $stack
     * 
     * @return self
     */
    public function addStack(Stack $stack): self
    {
        if (!$this->stacks->contains($stack)) {
            $this->stacks[] = $stack;
        }

        return $this;
    }

    /**
     * @param Stack $stack
     * 
     * @return self
     */
    public function removeStack(Stack $stack): self
    {
        $this->stacks->removeElement($stack);

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
