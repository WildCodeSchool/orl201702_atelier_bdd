<?php

namespace GotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Royaume
 *
 * @ORM\Table(name="royaume")
 * @ORM\Entity(repositoryClass="GotBundle\Repository\RoyaumeRepository")
 */
class Royaume
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="capitale", type="string", length=255)
     */
    private $capitale;

    /**
     * @var int
     *
     * @ORM\Column(name="nbHabitant", type="integer")
     */
    private $nbHabitant;

    /**
     * @ORM\OneToMany(targetEntity="Personnage", mappedBy="royaume")
     */
    private $personnages;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Royaume
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set capitale
     *
     * @param string $capitale
     *
     * @return Royaume
     */
    public function setCapitale($capitale)
    {
        $this->capitale = $capitale;

        return $this;
    }

    /**
     * Get capitale
     *
     * @return string
     */
    public function getCapitale()
    {
        return $this->capitale;
    }

    /**
     * Set nbHabitant
     *
     * @param integer $nbHabitant
     *
     * @return Royaume
     */
    public function setNbHabitant($nbHabitant)
    {
        $this->nbHabitant = $nbHabitant;

        return $this;
    }

    /**
     * Get nbHabitant
     *
     * @return int
     */
    public function getNbHabitant()
    {
        return $this->nbHabitant;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personnages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add personnage
     *
     * @param \GotBundle\Entity\Personnage $personnage
     *
     * @return Royaume
     */
    public function addPersonnage(\GotBundle\Entity\Personnage $personnage)
    {
        $this->personnages[] = $personnage;

        return $this;
    }

    /**
     * Remove personnage
     *
     * @param \GotBundle\Entity\Personnage $personnage
     */
    public function removePersonnage(\GotBundle\Entity\Personnage $personnage)
    {
        $this->personnages->removeElement($personnage);
    }

    /**
     * Get personnages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonnages()
    {
        return $this->personnages;
    }
}
