<?php

namespace Neon\ExchangeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Answer
 *
 * @author David Yell <neon1024@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="answers")
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $answer;

    /**
     * @ORM\Column(type="integer")
     */
    protected $upvotes;

    /**
     * @ORM\Column(type="integer")
     */
    protected $downvotes;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="answers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="answers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    protected $question;
}