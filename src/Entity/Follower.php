<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FollowerRepository")
 */
class Follower
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
    private $preference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $followerUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPreference(): ?string
    {
        return $this->preference;
    }

    public function setPreference(string $preference): self
    {
        $this->preference = $preference;

        return $this;
    }

    public function getFollowerUser(): ?string
    {
        return $this->followerUser;
    }

    public function setFollowerUser(string $followerUser): self
    {
        $this->followerUser = $followerUser;

        return $this;
    }
}
