<?php

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class AbstractEvent extends Event
{
    public abstract static function getName(): string;
}
