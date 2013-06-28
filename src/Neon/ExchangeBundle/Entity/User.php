<?php

namespace Neon\ExchangeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of User
 *
 * @author David Yell <neon1024@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="user")
     */
    protected $questions;

    /**
     * @ORM\OneTomany(targetEntity="Answer", mappedBy="user")
     */
    protected $answers;


    public function __construct() {
        $this->questions = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }
}