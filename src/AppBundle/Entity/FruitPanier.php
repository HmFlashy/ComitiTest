<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FruitPanier
 *
 * @ORM\Table(name="fruit_panier")
 * @ORM\Entity
 */
class FruitPanier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_panier", type="integer", nullable=false)
     */
    private $idPanier;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_fruit", type="integer", nullable=false)
     */
    private $idFruit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite_fruit", type="integer", nullable=false)
     */
    private $quantiteFruit;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set idPanier
     *
     * @param integer $idPanier
     * @return FruitPanier
     */
    public function setIdPanier($idPanier)
    {
        $this->idPanier = $idPanier;

        return $this;
    }

    /**
     * Get idPanier
     *
     * @return integer 
     */
    public function getIdPanier()
    {
        return $this->idPanier;
    }

    /**
     * Set idFruit
     *
     * @param integer $idFruit
     * @return FruitPanier
     */
    public function setIdFruit($idFruit)
    {
        $this->idFruit = $idFruit;

        return $this;
    }

    /**
     * Get idFruit
     *
     * @return integer 
     */
    public function getIdFruit()
    {
        return $this->idFruit;
    }

    /**
     * Set quantiteFruit
     *
     * @param integer $quantiteFruit
     * @return FruitPanier
     */
    public function setQuantiteFruit($quantiteFruit)
    {
        $this->quantiteFruit = $quantiteFruit;

        return $this;
    }

    /**
     * Get quantiteFruit
     *
     * @return integer 
     */
    public function getQuantiteFruit()
    {
        return $this->quantiteFruit;
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
