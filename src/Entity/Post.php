<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @OneToMany(targetEntity="App\Entity\Like", mappedBy="postsId")
     */
    private $id;
    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @return mixed
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
    /**
     * @ORM\Column(type="text")
     */
    private $content;
    /**
     * @ORM\Column(type="text")
     */
    private $title;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $teaser;
    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tag;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    private $linkToPicture;


    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return mixed
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * @param mixed $teaser
     */
    public function setTeaser(string $teaser): void
    {
        $this->teaser = $teaser;
    }

    /**
     * @param mixed $tag
     */
    public function setTag(string $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @return mixed
     */
    public function getLinkToPicture()
    {
        return $this->linkToPicture;
    }

    /**
     * @param mixed $linkToPicture
     */
    public function setLinkToPicture($linkToPicture): void
    {
        $this->linkToPicture = $linkToPicture;
    }
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @@ORM\JoinColumn(nullable=true)
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

    public function getPostCreator():?User
    {
        return $this->postCreator;
    }

    public function setPostCreator(User $postCreator)
    {
        $this->postCreator = $postCreator;

    }

}
