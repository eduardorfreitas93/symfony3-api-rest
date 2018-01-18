<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="login")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LoginRepository")
 */
class Login implements AdvancedUserInterface
{
    /**
     * @Groups({"login"})
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Groups({"login"})
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @Groups({"login_password"})
     * @ORM\Column(type="string", length=500)
     */
    private $password;

    /**
     * @Groups({"login"})
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @Groups({"login_referenced_user"})
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Users", mappedBy="login")
     */
    private $user;

    public function __construct()
    {
        $this->isActive = true;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
        return true;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * Get user
     *
     * @return Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param Users $user
     */
    public function setUser(Users $user)
    {
        $this->user = $user;
    }
}
