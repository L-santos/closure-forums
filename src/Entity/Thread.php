<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ThreadRepository")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class Thread
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
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $subject;

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
   
    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="threads")
     */
    private $user;
    
    /**
     * @var Forum
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Forum", inversedBy="threads")
     */
    private $forum;

    /**
     * @var Post[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="thread")
     */
    private $posts;

    /**
     * @var Post
     * 
     * @ORM\OneToOne(targetEntity="App\Entity\Post")
     */
    private $last_post;

    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean")
     */
    private $closed = false;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $views = 0;
    
    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->created_at = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSubject(string $subject): void 
    {
        $this->subject = $subject;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setForum(Forum $forum): void
    {
        $this->forum = $forum;
    }

    public function getForum(): Forum
    {
        return $this->forum;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function setLastPost(Post $last_post): void
    {
        $this->last_post = $last_post;
    }

    public function getLastPost(): ?Post
    {
        return $this->last_post;
    }

    public function isClosed(): bool
    {
        return $this->closed;
    }

    public function close(): void
    {
        $this->closed = true;
    }

    public function open(): void
    {
        $this->closed = false;
    }

    public function getViews(): bool
    {
        return $this->views;
    }

    public function addViews(int $ammount = 1): void
    {
        $this->views += $ammount;
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
