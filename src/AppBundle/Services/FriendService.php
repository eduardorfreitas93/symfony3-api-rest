<?php

namespace AppBundle\Services;

use AppBundle\Entity\Login;
use AppBundle\Services\AbstractService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Serializer\Serializer;

class FriendService extends AbstractService
{
    /**
     * Retorna todos os usuários da tabela Users
     *
     * @return \AppBundle\Entity\Users[]|array
     */
    public function getLogin()
    {
        $users = $this->entityManager->getRepository('AppBundle:Login')->findBy(array(), array('id' => 'ASC'));
        return $this->serializer->serialize($users, 'json', array('groups' => array('login', 'login_password', 'referenced_user', 'user')));
    }

    /**
     * Retorna todos os usuários da tabela Users
     *
     * @return \AppBundle\Entity\Users[]|array
     */
    public function getUser()
    {
        $users = $this->entityManager->getRepository('AppBundle:Users')->findBy(array(), array('id' => 'ASC'));
        return $this->serializer->serialize($users, 'json', array('groups' => array('user', 'referenced_login', 'login', 'login_password')));
    }
}