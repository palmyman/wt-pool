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
}
