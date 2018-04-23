<?php

namespace AppBundle\Services\FriendTat\Handler;

use AppBundle\Entity\Tatic;
use AppBundle\Event\EventRecorder;
use AppBundle\Event\TaticRelRegisteredEvent;
use AppBundle\Services\FriendTat\Command\CreateFriendTatCommand;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * CreateFriendTatHandler constructor.
     * @param EntityManager $em
     * @param EventRecorder $eventRecorder
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EntityManager $em,
        EventRecorder $eventRecorder,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->em = $em;
        $this->eventRecorder = $eventRecorder;
        $this->eventDispatcher = $eventDispatcher;
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

        return $taticEntity;
    }
}
