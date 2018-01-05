<?php

namespace AppBundle\Services;

use AppBundle\Entity\Login;
use AppBundle\Services\AbstractService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Serializer\Serializer;

class Helper extends AbstractService
{
    /**
     * Retorna todos os usuários da tabela Users
     *
     * @return \AppBundle\Entity\Users[]|array
     */
    public function holaMundo()
    {
        $users = $this->entityManager->getRepository('AppBundle:Login')->findBy(array(), array('id' => 'ASC'));
        return $this->serializer->serialize($users, 'json', array('groups' => array('login', 'login_password')));
    }

    /**
     * Retorna usuário por id da tabela Users
     *
     * @param $id
     * @return \AppBundle\Entity\Users|null|object
     */
    public function holaMundoId($id)
    {
        $user = $this->entityManager->getRepository('AppBundle:Users')->find($id);
        return $user;
    }

    public function saveLoginUser(ParameterBag $bag)
    {
        $em = $this->entityManager;

        $username = $bag->get('username');
        $password = $bag->get('password');

        $login = new Login();
        $login->setUsername($username);
        $login->setPassword($this->passwordEncoder->encodePassword($login, $password));

        $em->persist($login);
        $em->flush();

        return $login;
    }
}