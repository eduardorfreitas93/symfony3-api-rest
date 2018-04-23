<?php

namespace AppBundle\Event;


class TaticRelRegisteredEvent extends AbstractEvent
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    private $na;

    private $tatic;

    public function __construct($na, $tatic)
    {
        $this->na = $na;
        $this->tatic = $tatic;
        $this->createdAt = new \DateTime();
    }

    public function getNa()
    {
        return $this->na;
    }

    public function getTat()
    {
        return $this->tatic;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public static function getName(): string
    {
        return 'tatic_rel.registered';
    }
}
