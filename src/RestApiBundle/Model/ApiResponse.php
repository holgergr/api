<?php

namespace RestApiBundle\Model;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $statusCode;

    /**
     * @var array
     */
    private $header = [];

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return ApiResponse
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param string $statusCode
     * @return ApiResponse
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->data['id'] = $id;
    }

    /**
     * @param string $errorMsg
     */
    public function setError($errorMsg)
    {
        $this->data['error'] = $errorMsg;
    }

    /**
     * @return JsonResponse
     */
    public function getResponse()
    {
        $jsonResponse = new JsonResponse($this->data, $this->statusCode);
        foreach ($this->header as $name => $value) {
            $jsonResponse->headers->set($name, $value);
        }
        return $jsonResponse;
    }

    /**
     * @param $name
     * @param $value
     */
    public function addHeader($name, $value)
    {
        $this->header[$name] = $value;
    }
}
