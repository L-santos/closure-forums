<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 * 
 * @author Lucas Santos <email@here>
 */
class Status
{

    const APPROVED = 1;
    const PENDING = 2;
    const BLOCKED = 3;

    
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="integer")
     */
    private $value;

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;        
    }
}
