<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tatic;
use AppBundle\Services\FriendTat\Command\CreateFriendTatCommand;
use AppBundle\Services\FriendTat\Command\DeleteFriendTatCommand;
use AppBundle\Services\FriendTat\Command\UpdateFriendTatCommand;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FriendController
 * @package AppBundle\Controller
 * @Rest\Prefix("api/friend/tat")
 * @Rest\NamePrefix("api_friend_tat_")
 */
class FriendTatController extends AbstractController
{
    /**
     * @Rest\Get("")
     *
     * @param Request $request
     * @return array
     */
    public function getAction()
    {
//        $id = $request->request->get('id');

        $list = $this->get('app.friend-tat.query')->findId();

        return $this->responseBag($list);
    }

    /**
     * @Rest\Post("/create")
     */
    public function postAction(Request $request)
    {
        $tatic = $this->get('app.friend-tat.query')->save($request);

        return $this->responseBagForPersist($tatic);
    }

    /**
     * @Rest\Put("/update")
     */
    public function putAction(Request $request)
    {
        $tatic = $this->getServiceBus()->handle(new UpdateFriendTatCommand(
            $request->get('id'),
            $request->get('name'),
            $request->get('surname'),
            $request->get('email')
        ));

        return $this->responseBagForPersist($tatic);
    }

    /**
     * @Rest\Delete("/delete/{tatic}")
     */
    public function deleteAction(Tatic $tatic)
    {
        $tatic = $this->getServiceBus()->handle(new DeleteFriendTatCommand($tatic));

        return $this->responseBagForPersist($tatic);
    }
}
