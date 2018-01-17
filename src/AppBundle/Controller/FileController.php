<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class FileController
 * @package AppBundle\Controller
 * @Rest\Prefix("api/file")
 * @Rest\NamePrefix("api_file_")
 */
class FileController extends FOSRestController
{
    /**
     * @Rest\Post("/upload")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadImageAction(Request $request)
    {
        $fileService = $this->get('app.file.service');
        return $fileService->saveImage($request->files->get('file'));
    }

    /**
     * @Rest\Get("/images")
     *
     * @return JsonResponse
     */
    public function getImagesAction()
    {
        $images = $this->getDoctrine()->getRepository('AppBundle:File')->findAll();

        $data = $this->get('jms_serializer')->serialize($images, 'json');

        $res = array(
            'message'=>'imagem sucesso',
            'result'=>json_decode($data)
        );

        return new JsonResponse($res, 200);
    }
}