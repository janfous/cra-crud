<?php declare(strict_types=1);

namespace App\model\entity\Product;

use DateTime;

class Product
{

    private int $id = 0;

    private string $name;

    private int $price;

    private ?DateTime $dateCreated;

    public function __construct(int $id = 0, string $name = "", int $price = 0, $dateCreated = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param DateTime $dateCreated
     */
    public function setDateCreated(DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

}
