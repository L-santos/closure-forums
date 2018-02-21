<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class UserStatus
{

    const ACTIVE = 1;
    const INACTIVE = 2;
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
