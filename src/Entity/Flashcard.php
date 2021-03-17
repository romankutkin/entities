<?php

namespace App\Entity;

use App\Service\Database\TimestampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;

/**
 * @ORM\Entity
 * @ORM\Table(name="flashcards")
 */
class Flashcard
{
    use TimestampTrait;

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
    private $question;

    /**
     * @ORM\Column(type="string", nullable=false)
     * 
     * @var string|null
     */
    private $answer;

    /**
     * @ORM\ManyToMany(targetEntity=Stack::class, mappedBy="flashcards")
     */
    private $stacks;

    public function __construct()
    {
        $this->stacks = new ArrayCollection();
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
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * @param string $question
     * 
     * @return self
     */
    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     * 
     * @return self
     */
    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return Collection|Stack[]
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
            $stack->addFlashcard($this);
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
        if ($this->stacks->removeElement($stack)) {
            $stack->removeFlashcard($this);
        }

        return $this;
    }
}
