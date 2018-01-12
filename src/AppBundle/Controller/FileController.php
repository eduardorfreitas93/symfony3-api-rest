<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\File;

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
        $file = new File();

        $uploadedImage = $request->files->get('file');

        /** @var UploadedFile $image */
        $image = $uploadedImage;

        $imageName = md5(uniqid()).'.'.$image->guessExtension();
        $image->move($this->getParameter('image_dir'), $imageName);

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:Users')->find(5);

        $file->setName($imageName);
        $file->setCreateAt(new \DateTime());
        $file->setProfile(true);
        $file->setUser($user);

        $em->persist($file);
        $em->flush();

        $res = array('Message'=>'sucesso');

        $response = new JsonResponse($res);
        $response->setContent($res);

        return $response;
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