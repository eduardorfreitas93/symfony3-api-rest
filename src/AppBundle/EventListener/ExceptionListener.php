<?php

namespace AppBundle\EventListener;

use League\Tactician\Bundle\Middleware\InvalidCommandException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class ExceptionListener
 *
 * @package AppBundle\EventListener
 * @see http://symfony.com/doc/current/event_dispatcher.html
 */
class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $response = new JsonResponse();
        $exception = $event->getException();
        $message = $exception->getMessage();

        if ($exception instanceof InvalidCommandException) {
            $message = $this->getMessageForInvalidCommandException($exception);
        } else if ($exception instanceof AccessDeniedHttpException) {
            $message = "Recurso protegido. Mensagem: \"{$exception->getMessage()}\"";
        }

        $response->setData([
            'message' => $message
        ]);
        $event->setResponse($response);
    }

    /**
     * @param InvalidCommandException $exception
     * @return array
     */
    protected function getMessageForInvalidCommandException(InvalidCommandException $exception)
    {
        $violations = $exception->getViolations();
        $messages = [];

        foreach ($violations as $violation) {
            $messages[] = $violation->getMessage();
        }

        return $messages;
    }
}
