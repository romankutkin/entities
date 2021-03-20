<?php

namespace App\Entity;

use App\Service\Database\TimestampTrait;
use App\Service\Database\UidTrait;
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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
}
