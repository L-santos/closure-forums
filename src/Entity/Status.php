<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class Status
{

    const APPROVED = 1;
    const PENDING = 2;
    
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
     * @ORM\Column(type="string")
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
