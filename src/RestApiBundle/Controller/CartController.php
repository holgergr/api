<?php

namespace RestApiBundle\Controller;

use RestApiBundle\Model\ApiResponse;
use RestApiBundle\Transformer\CartTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    public function postAddAction(Request $request)
    {
        $response = new ApiResponse();

        $cartModel = $this->get('restapibundle.model.carts');
        $cartTransformer = new CartTransformer();
        $cart = $cartTransformer->transform($request->getContent());
        $cartModel->add($cart, $response);
        return $response->getResponse();
    }
}
