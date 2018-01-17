<?php

namespace AppBundle\Services;

use AppBundle\Entity\File;
use AppBundle\Repository\FileRepository;
use AppBundle\Repository\UsersRepository;
use AppBundle\Services\AbstractService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Serializer\Serializer;

class FileService extends AbstractService
{
    /**
     * Upload de imagem
     *
     * @param UploadedFile $image
     * @return JsonResponse
     */
    public function saveImage(UploadedFile $image)
    {
        $imageName = md5(uniqid()).'.'.$image->guessExtension();
        $image->move($this->container->getParameter('image_dir'), $imageName);

        $file = new File();
        $file->setName($imageName);
        $file->setCreateAt(new \DateTime());
        $file->setProfile(true);

        $this->entityManager->persist($file);
        $this->entityManager->flush();

        $res = array('Message'=>'sucesso', 'idImage' => $file->getId());

        $response = new JsonResponse($res);
        $response->setContent($res);

        return $response;
    }

    public function removeImage(File $file)
    {
        $this->entityManager->getRepository(File::class)->remove($file);
    }
}
