<?php

namespace RestApiBundle\Controller;

use RestApiBundle\Model\ApiResponse;
use RestApiBundle\Model\Items;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ItemsController extends Controller
{
    /**
     * @return ApiResponse
     */
    public function cgetListAction()
    {
        $response = new ApiResponse();

        $itemsModel = $this->get('restapibundle.model.items');
        $itemsModel->findAll($response);

        return $response->getResponse();
    }

    /**
     * @param Request $request
     * @param integer|null $id
     * @return ApiResponse
     */
    public function putSaveAction(Request $request, $id = null)
    {
        $response = new ApiResponse();

        $itemsModel = $this->get('restapibundle.model.items');
        $itemsModel->saveItem($itemsModel->transformToEntity($request->getContent(), $id), $response);

        return $response->getResponse();
    }
}
