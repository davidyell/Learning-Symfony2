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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $upvotes = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $downvotes = 0;

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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set upvotes
     *
     * @param integer $upvotes
     * @return Answer
     */
    public function setUpvotes($upvotes)
    {
        $this->upvotes = $upvotes;
    
        return $this;
    }

    /**
     * Get upvotes
     *
     * @return integer 
     */
    public function getUpvotes()
    {
        return $this->upvotes;
    }

    /**
     * Set downvotes
     *
     * @param integer $downvotes
     * @return Answer
     */
    public function setDownvotes($downvotes)
    {
        $this->downvotes = $downvotes;
    
        return $this;
    }

    /**
     * Get downvotes
     *
     * @return integer 
     */
    public function getDownvotes()
    {
        return $this->downvotes;
    }

    /**
     * Set user
     *
     * @param \Neon\ExchangeBundle\Entity\User $user
     * @return Answer
     */
    public function setUser(\Neon\ExchangeBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Neon\ExchangeBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set question
     *
     * @param \Neon\ExchangeBundle\Entity\Question $question
     * @return Answer
     */
    public function setQuestion(\Neon\ExchangeBundle\Entity\Question $question = null)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \Neon\ExchangeBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}