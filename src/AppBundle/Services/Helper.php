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
     * Gerenciar a criação do login e usuário
     *
     * @param ParameterBag $bag
     * @return array
     * @throws \Exception
     */
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

    /**
     * Validador dos campos
     *
     * @param ParameterBag $bag
     * @throws \Exception
     */
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

    /**
     * presave login
     *
     * @param ParameterBag $bag
     * @return Login
     */
    public function prepareSaveLogin(ParameterBag $bag)
    {
        $login = new Login();
        $login->setUsername($bag->get('login'));
        $login->setPassword($this->passwordEncoder->encodePassword($login, $bag->get('password')));

        return $this->saveLogin($login);
    }

    /**
     * save login
     *
     * @param Login $login
     * @return Login
     */
    public function saveLogin(Login $login)
    {
        return $this->entityManager->getRepository('AppBundle:Login')->save($login);
    }

    /**
     * presave usuário
     *
     * @param Login $login
     * @param ParameterBag $bag
     * @return Users
     */
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

    /**
     * save usuário
     *
     * @param Users $user
     * @return Users
     */
    public function saveUser(Users $user)
    {
        return $this->entityManager->getRepository('AppBundle:Users')->save($user);
    }
}
