<?php

declare(strict_types=1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @OneToMany(targetEntity="App\Entity\Comment", mappedBy="relatesToPostId")

     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;
    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


    /**
     * @ORM\Column(type="string")
     */
    private $postCreator;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPostCreator()
    {
        return $this->postCreator;
    }

    public function setPostCreator($postCreator): self
    {
        $this->postCreator = $postCreator;

        return $this;
    }
}
