<?php

namespace RestApiBundle\Tests;

use Doctrine\ORM\EntityManager;
use RestApiBundle\Entity\Cart;
use RestApiBundle\Model\ApiResponse;
use RestApiBundle\Model\Carts;
use RestApiBundle\Repository\CartRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CartsModelTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $cartMock = $this->getMock(Cart::class);
        $cartMock->expects($this->any())
            ->method('getItemId')
            ->will($this->returnValue(2));

        $cartRepositoryMock = $this
            ->getMockBuilder(CartRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cartRepositoryMock->expects($this->once())
            ->method('add')
            ->will($this->returnValue($cartMock));

        $emMock = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $emMock->expects($this->once())
            ->method('getRepository')->with('RestApiBundle:Cart')
            ->will($this->returnValue($cartRepositoryMock));

        $model = new Carts($emMock);
        $cart = new Cart();
        $cart->setCustomerId(1)->setItemId(2);
        $apiResponse = new ApiResponse();
        $model->add($cart, $apiResponse);

        $response = $apiResponse->getResponse();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertTrue($response->headers->contains('Location', '/path_to_cart/2'));
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
    }
}
