<?php

namespace WT\PoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pool
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pool
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="desciprion", type="string", length=255)
     */
    private $desciprion;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="pool")
     */
    protected $questions;


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
     * @return Pool
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
     * Set desciprion
     *
     * @param string $desciprion
     * @return Pool
     */
    public function setDesciprion($desciprion)
    {
        $this->desciprion = $desciprion;

        return $this;
    }

    /**
     * Get desciprion
     *
     * @return string 
     */
    public function getDesciprion()
    {
        return $this->desciprion;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add questions
     *
     * @param \WT\PoolBundle\Entity\Question $questions
     * @return Pool
     */
    public function addQuestion(\WT\PoolBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \WT\PoolBundle\Entity\Question $questions
     */
    public function removeQuestion(\WT\PoolBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
