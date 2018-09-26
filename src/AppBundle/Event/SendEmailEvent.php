<?php

namespace AppBundle\Event;

class SendEmailEvent extends AbstractEvent
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getTileName()
    {
        return $this->name;
    }

    public static function getName(): string
    {
        return 'send_email.event';
    }
}
