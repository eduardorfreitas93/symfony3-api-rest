<?php

namespace AppBundle\Services\FriendTat\Handler;

use AppBundle\Entity\Tatic;
use AppBundle\Services\FriendTat\Command\DeleteFriendTatCommand;
use Doctrine\ORM\EntityManager;

/**
 * Class DeleteFriendTatHandler
 * @package AppBundle\Services\FriendTat\Handler
 */
class DeleteFriendTatHandler
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
     * @param DeleteFriendTatCommand $command
     * @return boolean
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(DeleteFriendTatCommand $command): bool
    {
        $this->em->remove($command->tatic);
        $this->em->flush();

        return true;
    }
}
