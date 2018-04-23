<?php

namespace AppBundle\Services\TaticRel\Handler;

use AppBundle\Entity\Tatic;
use AppBundle\Services\FriendTat\Command\UpdateFriendTatCommand;
use Doctrine\ORM\EntityManager;

/**
 * Class UpdateFriendTatHandler
 * @package AppBundle\Services\TaticRel\Handler
 */
class UpdateTaticRelHandler
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
     * @param UpdateFriendTatCommand $command
     * @return Tatic
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(UpdateFriendTatCommand $command): Tatic
    {
        $taticEntity = $this->em->getReference(Tatic::class, $command->id);

        $taticEntity->setName($command->name);
        $taticEntity->setSurname($command->surname);
        $taticEntity->setEmail($command->email);

        $this->em->persist($taticEntity);
        $this->em->flush();

        return $taticEntity;
    }
}
