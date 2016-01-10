<?php

namespace RestApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="carts")
 * @ORM\Entity(repositoryClass="RestApiBundle\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $customerId;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $itemId;

    /**
     * Set customerId
     *
     * @param integer $customerId
     *
     * @return Cart
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set itemId
     *
     * @param integer $itemId
     *
     * @return Cart
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }
}
