<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FriendController
 * @package AppBundle\Controller
 * @Rest\Prefix("api/friend")
 * @Rest\NamePrefix("api_friend_")
 */
class FriendController extends FOSRestController
{
    /**
     * @Rest\Get("/user")
     * @return JsonResponse
     */
    public function getUserAction()
    {
        $helperService = $this->get('app.friend.service');
        $data = $helperService->getUser();
        $response = new JsonResponse($data);
        $response->setContent($data);

        return $response;
    }

    /**
     * @Rest\Get("/login")
     * @return JsonResponse
     */
    public function getLoginAction()
    {
        $helperService = $this->get('app.friend.service');
        $data = $helperService->getLogin();
        $response = new JsonResponse($data);
        $response->setContent($data);

        return $response;
    }
}