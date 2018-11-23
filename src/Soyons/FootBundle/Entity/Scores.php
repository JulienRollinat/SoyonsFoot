<?php

namespace Soyons\FootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scores
 *
 * @ORM\Table(name="Scores")
 * @ORM\Entity
 */
class Scores
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Ido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ido;

    /**
     * @var integer
     *
     * @ORM\Column(name="Scores", type="integer", nullable=false)
     */
    private $scores;



    /**
     * Get ido
     *
     * @return integer
     */
    public function getIdo()
    {
        return $this->ido;
    }

    /**
     * Set scores
     *
     * @param integer $scores
     *
     * @return Scores
     */
    public function setScores($scores)
    {
        $this->scores = $scores;

        return $this;
    }

    /**
     * Get scores
     *
     * @return integer
     */
    public function getScores()
    {
        return $this->scores;
    }
}
