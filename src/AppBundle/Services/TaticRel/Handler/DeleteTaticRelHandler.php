<?php

namespace AppBundle\Services\TaticRel\Handler;

use AppBundle\Entity\Tatic;
use AppBundle\Services\FriendTat\Command\DeleteFriendTatCommand;
use Doctrine\ORM\EntityManager;

/**
 * Class DeleteTaticRelHandler
 * @package AppBundle\Services\TaticRel\Handler
 */
class DeleteTaticRelHandler
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
