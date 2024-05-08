<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * #ORM\Table(name = "Patron")
 */
class Patron 
{
    /**
     * 
     * @ORM\#[ORM\Id]
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * Undocumented variable
     *
     * @ORM\Column(type = "string")
     */
    private $name;

    /**
     * Undocumented variable
     *
     * @ORM\Column(type = "string")
     */
    private $surname;

}



?>