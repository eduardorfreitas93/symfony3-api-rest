<?php

namespace AppBundle\Services\TaticRel\Handler;

use AppBundle\Entity\TaticRel;
use AppBundle\Services\TaticRel\Command\CreateTaticRelCommand;
use Doctrine\ORM\EntityManager;

/**
 * Class CreateTaticRelHandler
 * @package AppBundle\Services\TaticRel\Handler
 */
class CreateTaticRelHandler
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
     * @param CreateTaticRelCommand $command
     * @return TaticRel
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(CreateTaticRelCommand $command): TaticRel
    {
        $taticEntity = new TaticRel();

        $taticEntity->setName($command->name);
        $taticEntity->setTatic($command->taticId);

        $this->em->persist($taticEntity);
        $this->em->flush();

        return $taticEntity;
    }
}
