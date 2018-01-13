<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class Post
{
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     */
    private $user;

    /**
     * @var Thread
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Thread", inversedBy="posts")
     */
    private $thread;

    /**
     * @var string
     * 
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var Status
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Status")   
    */
    private $status;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $reported = 0;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function __construct(){
        $this->created_at = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setThread(Thread $thread): void
    {
        $this->thread = $thread;
    }

    public function getThread(): Thread
    {
        return $this->thread;
    }

    public function setContent(string $content): string
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;        
    }

    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): Status
    {
        return $this>status;
    }

    public function getReported(): int
    {
        return $this->reported;
    }

    public function addReported(int $value): void
    {
        $this->reported += $value;
    }
}
