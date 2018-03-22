<?php

namespace AppBundle\Services\FriendTat\Handler;

use AppBundle\Entity\Tatic;
use AppBundle\Services\FriendTat\Command\CreateFriendTatCommand;
use Doctrine\ORM\EntityManager;

/**
 * Class CreateFriendTatHandler
 * @package AppBundle\Services\FriendTat\Handler
 */
class CreateFriendTatHandler
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * CreateNewsHandler constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param CreateFriendTatCommand $command
     * @return Tatic
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateFriendTatCommand $command): Tatic
    {
        $taticEntity = new Tatic();

        $taticEntity->setName($command->name);
        $taticEntity->setSurname($command->surname);
        $taticEntity->setEmail($command->email);

        $this->em->persist($taticEntity);
        $this->em->flush();

        return $taticEntity;
    }
}
