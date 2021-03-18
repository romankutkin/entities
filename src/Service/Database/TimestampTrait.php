<?php

namespace App\Service\Database;

trait TimestampTrait
{
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
     * @ORM\PrePersist
     *
     * @return void
     */
    public function createTimestamps(): void
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function updateTimestamps(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
