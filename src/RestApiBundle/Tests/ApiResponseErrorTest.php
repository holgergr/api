<?php

namespace RestApiBundle\Tests;

use RestApiBundle\Model\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResponseErrorCase()
    {
        $apiResponse = new ApiResponse();
        $apiResponse->setError('error1');
        $apiResponse->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        $response = $apiResponse->getResponse();
        $this->assertSame('{"error":"error1"}', $response->getContent());
        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }
}
