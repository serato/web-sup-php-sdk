<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Message;

use Serato\UserProfileSdk\Message\AbstractMessage;

/**
 * A message representing a user's interactive purchase
 *
 * This message conveys data about the product purchased in an interactive manner.
 * At this point, it covers any product that has been invoiced from a user driven order,
 * such as those through the Express Checkout.
 *
 * In this message we are capturing:
 * - User ID
 * - Products
 * - Order Date
 * - Order ID
 */
class InteractivePurchase extends AbstractMessage
{
    private const PRODUCTS = 'products';
    private const ORDER_DATE = 'order_date';
    private const ORDER_ID = 'order_id';

    /*
        NOTE: This is a stop gap implementation - ideally these are already populated from other events in the SUP
        app, but they aren't. We require these to send over to Yotpo so we need them at the same time that orders
        come through.
    */
    private const FIRST_NAME = 'first_name';
    private const LAST_NAME = 'last_name';

    /**
     * Creates a new message instance
     *
     * @param int   $userId    User ID
     * @param array $params      Array of message parameters
     * @return self
     */
    public static function create(int $userId, array $params = []): self
    {
        return new static($userId, $params);
    }

    /**
     * Set the Products of the interactive purchase
     *
     * The Products should be an associative array containing `product_type_id` and `price`.
     * Products are expected to follow this schema example:
     *
     *  [
     *      [
     *          'product_type_id' => 145,
     *          'price'      => 20.0
     *      ],
     *      [
     *          'product_type_id' => 146,
     *          'price'      => 25.50
     *      ]
     *  ]
     *
     * @param array $products
     * @return self
     */
    public function setProducts(array $products): self
    {
        $this->setParam(self::PRODUCTS, $products);
        return $this;
    }

    /**
     * Get the Products from an interactive purchase
     *
     * @return array|null
     */
    public function getProducts(): ?array
    {
        return $this->getParam(self::PRODUCTS);
    }

    /**
     * Set the Order date of the interactive purchase
     *
     * @param string $orderDate
     * @return self
     */
    public function setOrderDate(string $orderDate): self
    {
        $this->setParam(self::ORDER_DATE, $orderDate);
        return $this;
    }

    /**
     * Get the Order date of the interactive purchase
     *
     * @return string|null
     */
    public function getOrderDate(): ?string
    {
        return $this->getParam(self::ORDER_DATE);
    }

    /**
     * Set the Order ID for the interactive purchase
     *
     * @param int $orderId
     * @return self
     */
    public function setOrderId(int $orderId): self
    {
        $this->setParam(self::ORDER_ID, $orderId);
        return $this;
    }

    /**
     * Get the Order Id of the interactive purchase
     *
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->getParam(self::ORDER_ID);
    }

    /**
     * Sets the first name of the customer who made the purchase
     *
     * @param string $firstName
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->setParam(self::FIRST_NAME, $firstName);
        return $this;
    }

    /**
     * Gets the first name of the customer who made the purchase
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->getParam(self::FIRST_NAME);
    }

    /**
     * Sets the last name of the customer who made the purchase
     *
     * @param string $lastName
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->setParam(self::LAST_NAME, $lastName);
        return $this;
    }

    /**
     * Gets the last name of the customer who made the purchase
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->getParam(self::LAST_NAME);
    }
}
