<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * 
 * @author Lucas Santos <email@here>
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", nullable=true)
     */
    private $first_name;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", nullable=true)
     */
    private $last_name;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", nullable=true)
     */
    private $birthdate;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", nullable=true)
     */
    private $ip_address;

    /**
     * @var array
     * 
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @var UserStatus
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\UserStatus")
     */
    private $status;
 
    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_login;

    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $reported = 0;

    /**
     * @var Thread
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="user")
     */
    private $threads;

    /**
     * @var Post
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="user")
     */
    private $posts;

    public function __construct(){
        $this->roles[] = "ROLE_USER";
    }
     
    public function getId(): int
    {
        return $this->id;
    }

    public function setUsername(User $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): User
    {
        return $this->username;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setBirthdate(\DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setIpAddress(string $ip_address): void
    {
        $this->ip_address = $ip_address;
    }

    public function getIpAddress(): string
    {
        return $this->ip_address;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): Status
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

    public function setLastLogin(\DateTime $last_login): void
    {
        $this->last_login = $last_login;
    }

    public function getLastLogin(): ?\DateTime
    {
        return $this->last_login;
    }

    public function getReported(): int
    {
        return $this->reported;
    }

    public function addReported(int $value): void
    {
        $this->reported += $value;
    }

    public function getThreads(): ?Thread
    {
        return $this->threads;
    }

    public function getPosts(): ?Post
    {
        return $this->posts;
    }

    public function getSalt(): ?string
    {
        //UserInterface
        //Returns the salt that was used to encode the password, if no salt was used, return null
        return null;
    }

    public function eraseCredentials(): void
    {
        //UserInterface
        //Removes sensitive data from the user
    }

    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized): void
    {
        list (
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize($serialized);
    }
}