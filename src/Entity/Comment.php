<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
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
    private $previousCommentId;

    /**
     * @ORM\Column(type="integer")
     */
    private $relatesToPostId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPreviousCommentId(): ?int
    {
        return $this->previousCommentId;
    }

    public function setPreviousCommentId(int $previousCommentId): self
    {
        $this->previousCommentId = $previousCommentId;

        return $this;
    }

    public function getRelatesToPostId(): ?int
    {
        return $this->relatesToPostId;
    }

    public function setRelatesToPostId(int $relatesToPostId): self
    {
        $this->relatesToPostId = $relatesToPostId;

        return $this;
    }
}
