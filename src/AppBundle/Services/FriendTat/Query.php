<?php

namespace AppBundle\Services\FriendTat;

use AppBundle\Entity\Tatic;
use AppBundle\Event\TaticRelRegisteredEvent;
use AppBundle\Services\AbstractService;
use AppBundle\Services\FriendTat\Command\CreateFriendTatCommand;
use AppBundle\Services\FriendTat\Command\DeleteFriendTatCommand;
use AppBundle\Services\FriendTat\Command\UpdateFriendTatCommand;
use AppBundle\Services\TaticRel\Command\CreateTaticRelCommand;
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

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function save(Request $request)
    {
        try {
            $this->entityManager->beginTransaction();

            $tatic = $this->getServiceBus()->handle(new CreateFriendTatCommand(
                $request->get('name'),
                $request->get('surname'),
                $request->get('email')
            ));

            $this->entityManager->commit();

            return $tatic;
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $tatic = $this->getServiceBus()->handle(new UpdateFriendTatCommand(
            $request->get('id'),
            $request->get('name'),
            $request->get('surname'),
            $request->get('email')
        ));

        return $tatic;
    }

    /**
     * @param Tatic $tatic
     */
    public function delete(Tatic $tatic): void
    {
        $this->getServiceBus()->handle(new DeleteFriendTatCommand($tatic));
    }
}
