<?php

namespace AppBundle\Services;

use AppBundle\Entity\Login;
use AppBundle\Entity\Users;
use AppBundle\Services\AbstractService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Serializer\Serializer;

class Helper extends AbstractService
{
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
        $this->entityManager->beginTransaction();
        try {
            $this->validation($bag);
            $login = $this->prepareSaveLogin($bag);
            $this->prepareSaveUser($login, $bag);

            $this->entityManager->commit();

            $token = $this->getToken($login);

            return array('token' => $token);
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }

    public function validation(ParameterBag $bag)
    {
        if (empty($bag->get('login'))){
            throw new \Exception('Login obrigatório');
        }

        if (empty($bag->get('password'))){
            throw new \Exception('Senha obrigatório');
        }

        if (empty($bag->get('name'))){
            throw new \Exception('Nome obrigatório');
        }

        if (empty($bag->get('surname'))){
            throw new \Exception('Sobrenome obrigatório');
        }

        if (empty($bag->get('email'))){
            throw new \Exception('Email obrigatório');
        }
    }

    public function prepareSaveLogin(ParameterBag $bag)
    {
        $login = new Login();
        $login->setUsername($bag->get('login'));
        $login->setPassword($this->passwordEncoder->encodePassword($login, $bag->get('password')));

        return $this->saveLogin($login);
    }

    public function saveLogin(Login $login)
    {
        return $this->entityManager->getRepository('AppBundle:Login')->save($login);
    }

    public function prepareSaveUser(Login $login, ParameterBag $bag)
    {
        $user = new Users();
        $user->setEmail($bag->get('email'));
        $user->setCreateAt(new \DateTime());
        $user->setName($bag->get('name'));
        $user->setSurname($bag->get('surname'));
        $user->setRole('ROLE_USER');
        $user->setLogin($login);

        return $this->saveUser($user);
    }

    public function saveUser(Users $user)
    {
        return $this->entityManager->getRepository('AppBundle:Users')->save($user);
    }
}
