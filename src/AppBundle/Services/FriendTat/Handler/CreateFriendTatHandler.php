<?php

namespace AppBundle\Services\FriendTat\Handler;

use AppBundle\Entity\Tatic;
use AppBundle\Event\EventRecorder;
use AppBundle\Event\SendEmailEvent;
use AppBundle\Event\TaticRelRegisteredEvent;
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
     * @var EventRecorder
     */
    private $eventRecorder;

    /**
     * CreateFriendTatHandler constructor.
     * @param EntityManager $em
     * @param EventRecorder $eventRecorder
     */
    public function __construct(
        EntityManager $em,
        EventRecorder $eventRecorder
    ) {
        $this->em = $em;
        $this->eventRecorder = $eventRecorder;
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

        $this->eventRecorder->record(new TaticRelRegisteredEvent($command->name, $taticEntity));
        $this->eventRecorder->record(new SendEmailEvent($command->name));

        return $taticEntity;
    }
}
