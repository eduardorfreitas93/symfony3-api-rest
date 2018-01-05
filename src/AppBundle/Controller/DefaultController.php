<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Rest\Get("/teste")
     * @return JsonResponse
     */
    public function getTesteAction()
    {
        $helperService = $this->get('app.helper.service');
        $data = $helperService->holaMundo();
        $response = new JsonResponse($data);
        $response->setContent($data);

        return $response;
    }

    /**
     * @Rest\Get("/teste/{id}")
     * @param $id
     * @return \AppBundle\Entity\Users[]|array
     */
    public function getTesteIdAction($id)
    {
        $helperService = $this->get('app.helper.service');
        return $helperService->holaMundoId($id);
    }

    /**
     * Registrar usuários
     *
     * @Rest\Post("/register")
     * @param Request $request
     * @return bool
     */
    public function postRegisterAction(Request $request)
    {
        $helperService = $this->get('app.helper.service');
        return $helperService->saveLoginUser($request->request);
    }
}