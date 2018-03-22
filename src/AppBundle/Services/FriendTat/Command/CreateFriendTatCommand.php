<?php

namespace AppBundle\Services\FriendTat\Command;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateFriendTatCommand
 *
 * @package AppBundle\Services\FriendTat\Command
 */
class CreateFriendTatCommand
{
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
    public function __construct($name, $surname, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }
}
