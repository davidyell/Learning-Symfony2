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
 * @ORM\Table(name="questions")
 */
class Question
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
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $question;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $upvotes = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $downvotes = 0;

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
     * Set title
     *
     * @param string $title
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set upvotes
     *
     * @param integer $upvotes
     * @return Question
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
     * @return Question
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
     * @return Question
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
     * Add answers
     *
     * @param \Neon\ExchangeBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\Neon\ExchangeBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;
    
        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Neon\ExchangeBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Neon\ExchangeBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}