<?php

namespace App\Entity;

use App\Repository\OrdersDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersDetailRepository::class)
 */
class OrdersDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="ordersDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderId;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="ordersDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productId;

    /**
     * @ORM\Column(type="integer")
     */
    private $proQuantity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?Orders
    {
        return $this->orderId;
    }

    public function setOrderId(?Orders $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->productId;
    }

    public function setProductId(?Product $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProQuantity(): ?int
    {
        return $this->proQuantity;
    }

    public function setProQuantity(int $proQuantity): self
    {
        $this->proQuantity = $proQuantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }
}
