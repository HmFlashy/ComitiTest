<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_transaction", type="date", nullable=false)
     */
    private $dateTransaction;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ttc", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalTtc;

    /**
     * @var float
     *
     * @ORM\Column(name="total_ht", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalHt;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * Set dateTransaction
     *
     * @param \DateTime $dateTransaction
     * @return Panier
     */
    public function setDateTransaction($dateTransaction)
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    /**
     * Get dateTransaction
     *
     * @return \DateTime 
     */
    public function getDateTransaction()
    {
        return $this->dateTransaction;
    }

    /**
     * Set totalTtc
     *
     * @param float $totalTtc
     * @return Panier
     */
    public function setTotalTtc($totalTtc)
    {
        $this->totalTtc = $totalTtc;

        return $this;
    }

    /**
     * Get totalTtc
     *
     * @return float 
     */
    public function getTotalTtc()
    {
        return $this->totalTtc;
    }

    /**
     * Set totalHt
     *
     * @param float $totalHt
     * @return Panier
     */
    public function setTotalHt($totalHt)
    {
        $this->totalHt = $totalHt;

        return $this;
    }

    /**
     * Get totalHt
     *
     * @return float 
     */
    public function getTotalHt()
    {
        return $this->totalHt;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Panier
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
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
