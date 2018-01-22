<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Rest\Prefix("api")
 * @Rest\NamePrefix("api_")
 */
class DefaultController extends FOSRestController
{
    /**
     * Registrar usuários
     *
     * @Rest\Post("/register")
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function postRegisterAction(Request $request)
    {
        $helperService = $this->get('app.helper.service');
        return $helperService->saveLoginUser($request->request);
    }

    /**
     * @Rest\Get("/token-firebase/{uid}")
     * @param $uid
     * @return string
     */
    public function getTokenFirebaseAction($uid)
    {
        $tokenFirebaseService = $this->get('app.token.firebase.service');
        return $tokenFirebaseService->createToken($uid);
    }
}