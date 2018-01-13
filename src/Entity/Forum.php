<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumRepository")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 * 
 * @todo Forum permissions 
 * @see https://symfony.com/doc/current/security.html#security-role-hierarchy
 * @see https://symfony.com/doc/current/security/voters.html
 */
class Forum
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
    private $name;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", nullable=true)    
     */
    private $description;

    /**
     * @var string
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="forum")
     */
    private $threads;

    /**
     * @var Thread
     * 
     * @ORM\OneToOne(targetEntity="App\Entity\Thread")
     * @ORM\JoinColumn(nullable=true)
     */
    private $last_thread;

    /**
     * @var Forum
     * 
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="children")
     */
    private $parent;

    /**
     * @var Forum[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Forum", mappedBy="parent")
     */
    private $children;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->threads = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;        
    }

    public function setSlug(String $slug): void
    {
        $this->slug = $slug;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getThreads(): ?Collection
    {
        return $this->threads;
    }

    public function setLastThread(Thread $thread): void
    {
        $this->last_thread = $thread;
    }

    public function getLastThread(): ?Thread
    {
        return $this->last_thread;
    }

    public function setDescription(string $description): string
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setParent(Forum $parent): void
    {
        $this->parent = $parent;
    }

    public function getParent(): ?Forum
    {
        return $this->parent;
    }

    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function getChildren(): ?Collection
    {
        return $this->children;
    }
}
