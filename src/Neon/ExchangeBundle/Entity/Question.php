<?php

namespace Neon\ExchangeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Question
 *
 * @author David Yell <neon1024@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table(name='questions')
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\Colum(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $question;

    /**
     * @ORM\Column(type="integer")
     */
    protected $upvotes;

    /**
     * @ORM\Column(type="integer")
     */
    protected $downvotes;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="questions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    protected $answers;

    public function __construct() {
        $this->answers = new ArrayCollection();
    }
}