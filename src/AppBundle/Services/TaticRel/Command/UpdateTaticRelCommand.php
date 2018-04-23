<?php

namespace AppBundle\Services\TaticRel\Command;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UpdateTaticRelCommand
 *
 * @package AppBundle\Services\TaticRel\Command
 */
class UpdateTaticRelCommand
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    public $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max = 50)
     * @Assert\Type(type="string")
     */
    public $name;

    /**
     * CreateTaticRelCommand constructor.
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
