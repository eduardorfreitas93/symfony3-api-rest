<?php

namespace AppBundle\Services;

use AppBundle\Entity\Login;
use Doctrine\ORM\EntityManager;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractService
{
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
     * Gerar token
     *
     * @param Login $login
     * @return string
     */
    public function getToken(Login $login)
    {
        return $this->jwt->encode([
                'username' => $login->getUsername(),
                'exp' => time() + $this->container->getParameter('jwt_token_ttl'),
            ]);
    }
}