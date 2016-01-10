<?php

namespace RestApiBundle\Util;

use RestApiBundle\Model\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     * @throws \Exception
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $message = sprintf(
            'Exception: %s with code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );

        $response = new ApiResponse();
        $response->setError($message);
        $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

        $event->setResponse($response->getResponse());
    }
}
