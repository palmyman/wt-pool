<?php

namespace WT\PoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QOption
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class QOption
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
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="qOptions")
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
     * Set text
     *
     * @param string $text
     * @return QOption
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
     * Set question
     *
     * @param \WT\PoolBundle\Entity\Question $question
     * @return QOption
     */
    public function setQuestion(\WT\PoolBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \WT\PoolBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
