<?php

declare(strict_types=1);

namespace Serato\UserProfileSdk\Test\Message;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Serato\UserProfileSdk\Message\InteractivePurchase;

class InteractivePurchaseTest extends PHPUnitTestCase
{
    public function testSetters0()
    {
        $userId = 123;
        $orderDate = '2021-02-02T00:00:00+00:00';
        $orderId = 25;
        $products = [
            [
                "product_type_id" => 15,
                "price"      => 50.20
            ],
            [
                "product_type_id" => 150,
                "price"      => 500.20
            ]
        ];
        $firstName = 'Ben';
        $lastName = 'Swolo';

        $interactivePurchase = InteractivePurchase::create($userId)
                                ->setProducts($products)
                                ->setOrderDate($orderDate)
                                ->setOrderId($orderId)
                                ->setFirstName($firstName)
                                ->setLastName($lastName);
        $this->assertEquals('InteractivePurchase', $interactivePurchase->getType());
        $this->assertEquals($interactivePurchase->getUserId(), $userId);
        $this->assertEquals($interactivePurchase->getProducts(), $products);
        $this->assertEquals($interactivePurchase->getOrderDate(), $orderDate);
        $this->assertEquals($interactivePurchase->getOrderId(), $orderId);
        $this->assertEquals($interactivePurchase->getFirstName(), $firstName);
        $this->assertEquals($interactivePurchase->getLastName(), $lastName);
    }

    public function testSetters1()
    {
        $userId = 124;
        $orderDate = '2021-03-02T00:00:00+00:00';
        $orderId = 26;
        $firstName = 'Jar Jar';
        $lastName = 'Binks';
        $products = [
            [
                "product_type_id" => 16,
                "price"      => 50.20
            ],
            [
                "product_type_id" => 162,
                "price"      => 501.20
            ]
        ];

        $interactivePurchase = InteractivePurchase::create($userId, [
            "products" => $products,
            "order_date" => $orderDate,
            "order_id" => $orderId,
            "first_name" => $firstName,
            "last_name" => $lastName
        ]);

        $this->assertEquals('InteractivePurchase', $interactivePurchase->getType());
        $this->assertEquals($interactivePurchase->getUserId(), $userId);
        $this->assertEquals($interactivePurchase->getProducts(), $products);
        $this->assertEquals($interactivePurchase->getOrderDate(), $orderDate);
        $this->assertEquals($interactivePurchase->getOrderId(), $orderId);
        $this->assertEquals($interactivePurchase->getFirstName(), $firstName);
        $this->assertEquals($interactivePurchase->getLastName(), $lastName);
    }
}
