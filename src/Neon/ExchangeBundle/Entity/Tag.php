<?php
namespace Neon\ExchangeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tag
 *
 * @author David Yell <neon1024@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="tags")
 * @ORM\HasLifecycleCallbacks()
 */
class Tag
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
    protected $name;
	
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
	protected $created;
	
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
	protected $modified;

	/**
	 * @ORM\ManyToMany(targetEntity="Question", inversedBy="tags")
	 * @ORM\JoinTable(name="questions_tags")
	 */
	private $questions;
	
	
	public function __construct() {
		$this->questions = new ArrayCollection();
	}
	
    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setModifiedValue()
    {
        $this->modified = new \DateTime();
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
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}