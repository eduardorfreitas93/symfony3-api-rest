<?php

namespace AppBundle\Services;

use AppBundle\Entity\Login;
use Doctrine\ORM\EntityManager;
use League\Tactician\CommandBus;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractService
{

    const COMMAND_BUS_TRANSACTIONAL = 'tactician.commandbus.transactional';

    const COMMAND_BUS_NON_TRANSACTIONAL = 'tactician.commandbus';

    const COMMAND_BUS_QUEUED = 'tactician.commandbus.queued';

    /** @var EntityManager $entityManager */
    public $entityManager;

    /** @var UserPasswordEncoder $passwordEncoder */
    public $passwordEncoder;

    /** @var Serializer $serializer */
    public $serializer;

    /** @var JWTEncoderInterface $jwt */
    public $jwt;

    /** @var ContainerInterface $container */
    public $container;

    /** @var EventDispatcherInterface $eventDispatcher */
    public $eventDispatcher;

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param UserPasswordEncoder $passwordEncoder
     */
    public function setPasswordEncoder(UserPasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param Serializer $serializer
     */
    public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param JWTEncoderInterface $jwt
     */
    public function setJwtAuthentication(JWTEncoderInterface $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name
     * @return CommandBus
     */
    public function getServiceBus(string $name = self::COMMAND_BUS_TRANSACTIONAL): CommandBus
    {
        return $this->container->get($name);
    }

    /**
     * @param Login $login
     * @return string
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function getToken(Login $login)
    {
        return $this->jwt->encode([
                'username' => $login->getUsername(),
                'exp' => time() + $this->container->getParameter('jwt_token_ttl'),
            ]);
    }
}