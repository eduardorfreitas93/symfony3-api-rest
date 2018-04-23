<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * TaticRel
 *
 * @ORM\Table(name="tatic_rel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaticRelRepository")
 */
class TaticRel
{
    /**
     * @var int
     *
     * @Groups({"tatic_rel"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"tatic_rel"})
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var \AppBundle\Entity\Tatic
     *
     * @Groups({"tatic_rel_referenced_tatic"})
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Tatic", inversedBy="taticRel")
     * @ORM\JoinColumn(name="tatic_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tatic;

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
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Get tatic
     *
     * @return Tatic
     */
    public function getTatic(): Tatic
    {
        return $this->tatic;
    }

    /**
     * Set tatic
     *
     * @param Tatic $tatic
     */
    public function setTatic(Tatic $tatic): void
    {
        $this->tatic = $tatic;
    }
}
