<?php

namespace AppBundle\Services\TaticRel\Command;

use AppBundle\Entity\TaticRel;

/**
 * Class DeleteTaticRelCommand
 *
 * @package AppBundle\Services\TaticRel\Command
 */
class DeleteTaticRelCommand
{
    /**
     * @var TaticRel $taticRel
     */
    public $taticRel;

    /**
     * CreateTaticRelCommand constructor.
     */
    public function __construct($taticRel)
    {
        $this->taticRel = $taticRel;
    }
}
