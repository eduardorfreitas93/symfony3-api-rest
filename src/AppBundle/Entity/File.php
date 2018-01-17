<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FileRepository")
 */
class File
{
    /**
     * @var int
     *
     * @Groups({"file"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"file"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @Groups({"file"})
     * @ORM\Column(name="profile", type="boolean")
     */
    private $profile;

    /**
     * @var \DateTime
     *
     * @Groups({"file"})
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @Groups({"file_referenced_user"})
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Users", mappedBy="file")
     */
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return File
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
     * Set profile
     *
     * @param bool $profile
     *
     * @return File
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return bool
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return File
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
     * @param ArrayCollection $user
     */
    public function setUser(ArrayCollection $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}
