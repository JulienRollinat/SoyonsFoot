<?php

namespace Soyons\FootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lesmatchs
 *
 * @ORM\Table(name="Lesmatchs")
 * @ORM\Entity
 */
class Lesmatchs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Idette", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idette;

    /**
     * @var integer
     *
     * @ORM\Column(name="Equipe 1", type="integer", nullable=false)
     */
    private $equipe1;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nul", type="integer", nullable=false)
     */
    private $nul;

    /**
     * @var integer
     *
     * @ORM\Column(name="Equipe 2", type="integer", nullable=false)
     */
    private $equipe2;



    /**
     * Get idette
     *
     * @return integer
     */
    public function getIdette()
    {
        return $this->idette;
    }

    /**
     * Set equipe1
     *
     * @param integer $equipe1
     *
     * @return Lesmatchs
     */
    public function setEquipe1($equipe1)
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    /**
     * Get equipe1
     *
     * @return integer
     */
    public function getEquipe1()
    {
        return $this->equipe1;
    }

    /**
     * Set nul
     *
     * @param integer $nul
     *
     * @return Lesmatchs
     */
    public function setNul($nul)
    {
        $this->nul = $nul;

        return $this;
    }

    /**
     * Get nul
     *
     * @return integer
     */
    public function getNul()
    {
        return $this->nul;
    }

    /**
     * Set equipe2
     *
     * @param integer $equipe2
     *
     * @return Lesmatchs
     */
    public function setEquipe2($equipe2)
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    /**
     * Get equipe2
     *
     * @return integer
     */
    public function getEquipe2()
    {
        return $this->equipe2;
    }
}
