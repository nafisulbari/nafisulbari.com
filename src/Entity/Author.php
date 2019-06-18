<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $a_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $a_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $a_pass;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAName(): ?string
    {
        return $this->a_name;
    }

    public function setAName(string $a_name): self
    {
        $this->a_name = $a_name;

        return $this;
    }

    public function getAEmail(): ?string
    {
        return $this->a_email;
    }

    public function setAEmail(string $a_email): self
    {
        $this->a_email = $a_email;

        return $this;
    }

    public function getAPass(): ?string
    {
        return $this->a_pass;
    }

    public function setAPass(string $a_pass): self
    {
        $this->a_pass = $a_pass;

        return $this;
    }
}
