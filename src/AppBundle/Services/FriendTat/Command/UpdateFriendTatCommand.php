<?php

namespace AppBundle\Services\FriendTat\Command;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UpdateFriendTatCommand
 *
 * @package AppBundle\Services\FriendTat\Command
 */
class UpdateFriendTatCommand
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
     * @Assert\NotBlank()
     * @Assert\Length(max = 50)
     * @Assert\Type(type="string")
     */
    public $surname;

    /**
     * @Assert\Length(max = 255)
     * @Assert\Email()
     */
    public $email;

    /**
     * CreateFriendTatCommand constructor.
     */
    public function __construct($id, $name, $surname, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }
}
