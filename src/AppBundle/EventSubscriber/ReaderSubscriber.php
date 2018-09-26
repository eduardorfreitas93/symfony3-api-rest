<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Services\TaticRel\Command\CreateTaticRelCommand;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Event\TaticRelRegisteredEvent;
use AppBundle\Event\SendEmailEvent;
use League\Tactician\CommandBus;

class ReaderSubscriber implements EventSubscriberInterface
{
    /**
     * @var CommandBus
     */
    private $serviceBus;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment $templating
     */
    private $templating;

    public function __construct(CommandBus $serviceBus, \Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->serviceBus = $serviceBus;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            TaticRelRegisteredEvent::getName() => 'whenReaderBookRegistered',
            SendEmailEvent::getName() => 'sendEmail'
        ];
    }

    public function whenReaderBookRegistered(TaticRelRegisteredEvent $event)
    {
        $this->serviceBus->handle(new CreateTaticRelCommand(
            $event->getNa(),
            $event->getTat()
        ));
    }

    public function sendEmail()
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('eduardorfreitas93@gmail.com')
            ->setTo('duduramos1@gmail.com')
            ->setBody(
                $this->templating->render(
                    ':Emails:registration.html.twig',
                    array('name' => 'teste')
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
