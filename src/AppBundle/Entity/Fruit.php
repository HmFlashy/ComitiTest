<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fruit
 *
 * @ORM\Table(name="fruit")
 * @ORM\Entity
 */
class Fruit
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_fruit", type="string", length=255, nullable=false)
     */
    private $nomFruit;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_ht", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixHt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set nomFruit
     *
     * @param string $nomFruit
     * @return Fruit
     */
    public function setNomFruit($nomFruit)
    {
        $this->nomFruit = $nomFruit;

        return $this;
    }

    /**
     * Get nomFruit
     *
     * @return string 
     */
    public function getNomFruit()
    {
        return $this->nomFruit;
    }

    /**
     * Set prixHt
     *
     * @param float $prixHt
     * @return Fruit
     */
    public function setPrixHt($prixHt)
    {
        $this->prixHt = $prixHt;

        return $this;
    }

    /**
     * Get prixHt
     *
     * @return float 
     */
    public function getPrixHt()
    {
        return $this->prixHt;
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
}
