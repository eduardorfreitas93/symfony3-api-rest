<?php

namespace AppBundle\Services\FriendTat\Command;

use AppBundle\Entity\Tatic;

/**
 * Class DeleteFriendTatCommand
 *
 * @package AppBundle\Services\FriendTat\Command
 */
class DeleteFriendTatCommand
{
    /**
     * @var Tatic $tatic
     */
    public $tatic;

    /**
     * CreateFriendTatCommand constructor.
     */
    public function __construct($tatic)
    {
        $this->tatic = $tatic;
    }
}
