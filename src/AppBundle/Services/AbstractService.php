<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
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
}