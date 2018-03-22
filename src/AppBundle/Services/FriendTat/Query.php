<?php

namespace AppBundle\Services\FriendTat;

use AppBundle\Entity\Tatic;
use AppBundle\Services\AbstractService;
use AppBundle\Services\FriendTat\Command\CreateFriendTatCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Query
 * @package AppBundle\Service\FriendTat
 */
class Query extends AbstractService
{
    public function findId()
    {
        $tatic = $this->entityManager->getRepository(Tatic::class)->findAll();

        return $this->serializer->normalize($tatic, null, array(
            'groups' => array(
                'tatic'
            )
        ));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findArrayById(int $id)
    {
        return $this->entityManager->getRepository(Tatic::class)->findArrayById($id);
    }

    public function save(Request $request)
    {
        $tatic = $this->getServiceBus()->handle(new CreateFriendTatCommand(
            $request->get('name'),
            $request->get('surname'),
            $request->get('email')
        ));

        return $tatic;
    }
}
