<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tatic;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FriendTatRelController
 * @package AppBundle\Controller
 * @Rest\Prefix("api/friend/tat/rel")
 * @Rest\NamePrefix("api_friend_tat_rel_")
 */
class FriendTatRelController extends AbstractController
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
        $tatic = $this->get('app.friend-tat-rel.query')->save($request);

        return $this->responseBagForPersist($tatic);
    }

    /**
     * @Rest\Put("/update")
     */
    public function putAction(Request $request)
    {
        $tatic = $this->get('app.friend-tat-rel.query')->update($request);

        return $this->responseBagForPersist($tatic);
    }

    /**
     * @Rest\Delete("/delete/{tatic}")
     */
    public function deleteAction(Tatic $tatic)
    {
        $this->get('app.friend-tat-rel.query')->delete($tatic);
        
        return $this->responseBagForPersist($tatic);
    }
}
