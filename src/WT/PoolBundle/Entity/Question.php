<?php

namespace WT\PoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Question
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
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="true", type="integer")
     */
    private $true;

    /**
     * @var integer
     *
     * @ORM\Column(name="false", type="integer")
     */
    private $false;

    /**
     * @ORM\ManyToOne(targetEntity="Pool", inversedBy="questions")
     */
    protected $pool;

    /**
     * @ORM\OneToMany(targetEntity="QOption", mappedBy="question")
     */
    protected $qOptions;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    protected $answers;    

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
     * Set text
     *
     * @param string $text
     * @return Question
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set pool
     *
     * @param \WT\PoolBundle\Entity\Pool $pool
     * @return Question
     */
    public function setPool(\WT\PoolBundle\Entity\Pool $pool = null)
    {
        $this->pool = $pool;        

        return $this;
    }

    /**
     * Get pool
     *
     * @return \WT\PoolBundle\Entity\Pool 
     */
    public function getPool()
    {
        return $this->pool;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->qOptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add qOptions
     *
     * @param \WT\PoolBundle\Entity\QOption $qOptions
     * @return Question
     */
    public function addQOption(\WT\PoolBundle\Entity\QOption $qOptions)
    {
        $this->qOptions[] = $qOptions;

        return $this;
    }

    /**
     * Remove qOptions
     *
     * @param \WT\PoolBundle\Entity\QOption $qOptions
     */
    public function removeQOption(\WT\PoolBundle\Entity\QOption $qOptions)
    {
        $this->qOptions->removeElement($qOptions);
    }

    /**
     * Get qOptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQOptions()
    {
        return $this->qOptions;
    }

    /**
     * Add answers
     *
     * @param \WT\PoolBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\WT\PoolBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \WT\PoolBundle\Entity\Answer $answers
     */
    public function removeAnswer(\WT\PoolBundle\Entity\Answer $answers)
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

    /**
     * Set true
     *
     * @param integer $true
     * @return Question
     */
    public function setTrue($true)
    {
        $this->true = $true;

        return $this;
    }

    /**
     * Inc true
     *
     * @return Question
     */
    public function incTrue()
    {
        $this->true++;

        return $this;
    }

    /**
     * Get true
     *
     * @return integer 
     */
    public function getTrue()
    {
        return $this->true;
    }

    /**
     * Set false
     *
     * @param integer $false
     * @return Question
     */
    public function setFalse($false)
    {
        $this->false = $false;

        return $this;
    }

    /**
     * Inc false
     *
     * @return Question
     */
    public function incFalse()
    {
        $this->false++;

        return $this;
    }

    /**
     * Get false
     *
     * @return integer 
     */
    public function getFalse()
    {
        return $this->false;
    }
}
