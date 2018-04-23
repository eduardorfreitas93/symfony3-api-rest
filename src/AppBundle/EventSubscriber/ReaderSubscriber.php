<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Services\TaticRel\Command\CreateTaticRelCommand;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Event\TaticRelRegisteredEvent;
use League\Tactician\CommandBus;

class ReaderSubscriber implements EventSubscriberInterface
{
    /**
     * @var CommandBus
     */
    private $serviceBus;

    public function __construct(CommandBus $serviceBus)
    {
        $this->serviceBus = $serviceBus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            TaticRelRegisteredEvent::getName() => 'whenReaderBookRegistered'
        ];
    }

    public function whenReaderBookRegistered(TaticRelRegisteredEvent $event)
    {
        $this->serviceBus->handle(new CreateTaticRelCommand(
            $event->getNa(),
            $event->getTat()
        ));
    }
}
