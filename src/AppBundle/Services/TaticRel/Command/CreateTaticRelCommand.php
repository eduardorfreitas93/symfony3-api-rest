<?php

namespace AppBundle\Services\TaticRel\Command;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Tatic;

/**
 * Class CreateTaticRelCommand
 *
 * @package AppBundle\Services\TaticRel\Command
 */
class CreateTaticRelCommand
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max = 50)
     * @Assert\Type(type="string")
     */
    public $name;

    public $taticId;

    /**
     * CreateFriendTatCommand constructor.
     */
    public function __construct($name, Tatic $taticId)
    {
        $this->name = $name;
        $this->taticId = $taticId;
    }
}
