<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeRepository")
 */
class Like
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $postsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $personThatLiked;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostsId(): ?int
    {
        return $this->postsId;
    }

    public function setPostsId(int $postsId): self
    {
        $this->postsId = $postsId;

        return $this;
    }

    public function getPersonThatLiked(): ?string
    {
        return $this->personThatLiked;
    }

    public function setPersonThatLiked(string $personThatLiked): self
    {
        $this->personThatLiked = $personThatLiked;

        return $this;
    }
}
