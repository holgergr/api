<?php

namespace RestApiBundle\Tests;

use Doctrine\ORM\EntityManager;
use RestApiBundle\Entity\Item;
use RestApiBundle\Model\ApiResponse;
use RestApiBundle\Model\Items;
use RestApiBundle\Repository\ItemRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ItemsModelTest extends \PHPUnit_Framework_TestCase
{
    public function testAddUpdate()
    {
        $model = new Items($this->getEntityManagerMock());
        $item = new Item();
        $item->setId(1)->setPrice(22)->setDescription('Description')->setName('name');
        $apiResponse = new ApiResponse();
        $model->saveItem($item, $apiResponse);

        $response = $apiResponse->getResponse();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testAddNew()
    {
        $model = new Items($this->getEntityManagerMock());
        $item = new Item();
        $item->setPrice(22)->setDescription('Description')->setName('name');
        $apiResponse = new ApiResponse();
        $model->saveItem($item, $apiResponse);

        $response = $apiResponse->getResponse();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getEntityManagerMock()
    {
        $itemMock = $this->getMock(Item::class);
        $itemMock->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));

        $itemRepositoryMock = $this
            ->getMockBuilder(ItemRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $constraint = new \PHPUnit_Framework_Constraint_Or();
        $constraint->setConstraints(['update', 'add']);
        $itemRepositoryMock->expects($this->once())
            ->method($constraint)
            ->will($this->returnValue($itemMock));

        $emMock = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $emMock->expects($this->once())
            ->method('getRepository')->with('RestApiBundle:Item')
            ->will($this->returnValue($itemRepositoryMock));
        return $emMock;
    }
}
