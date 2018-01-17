<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 */
class Users
{
    /**
     * @var int
     *
     * @Groups({"user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"user"})
     * @ORM\Column(name="role", type="string", length=20)
     */
    private $role;

    /**
     * @var string
     *
     * @Groups({"user"})
     * @ORM\Column(name="name", type="string", length=180)
     */
    private $name;

    /**
     * @var string
     *
     * @Groups({"user"})
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @Groups({"user"})
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @Groups({"user"})
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @var \AppBundle\Entity\Login
     *
     * @Groups({"user_referenced_login"})
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Login", inversedBy="user")
     * @ORM\JoinColumn(name="login", referencedColumnName="id")
     */
    private $login;

    /**
     * @var \AppBundle\Entity\File
     *
     * @Groups({"users_referenced_file"})
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\File", inversedBy="user")
     * @ORM\JoinColumn(name="image_profile", referencedColumnName="id", onDelete="CASCADE")
     */
    private $file;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Users
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Users
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Users
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Get login
     *
     * @return Login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set login
     *
     * @param Login $login
     */
    public function setLogin(Login $login)
    {
        $this->login = $login;
    }

    /**
     * Get file
     *
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }
}

