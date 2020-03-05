<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Blogpost", mappedBy="category")
     */
    private $blogpost;

    public function __construct()
    {
        $this->blogpost = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Blogpost[]
     */
    public function getBlogpost(): Collection
    {
        return $this->blogpost;
    }

    public function addBlogpost(Blogpost $blogpost): self
    {
        if (!$this->blogpost->contains($blogpost)) {
            $this->blogpost[] = $blogpost;
            $blogpost->setCategory($this);
        }

        return $this;
    }

    public function removeBlogpost(Blogpost $blogpost): self
    {
        if ($this->blogpost->contains($blogpost)) {
            $this->blogpost->removeElement($blogpost);
            // set the owning side to null (unless already changed)
            if ($blogpost->getCategory() === $this) {
                $blogpost->setCategory(null);
            }
        }

        return $this;
    }
}
