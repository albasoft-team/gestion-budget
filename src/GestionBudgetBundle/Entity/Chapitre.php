<?php

namespace GestionBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chapitre
 *
 * @ORM\Table(name="chapitre")
 * @ORM\Entity(repositoryClass="GestionBudgetBundle\Repository\ChapitreRepository")
 */
class Chapitre
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
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity="Compte", mappedBy="chapitre")
     */
    private $comptes;


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
     * Set designation
     *
     * @param string $designation
     *
     * @return Chapitre
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comptes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add compte
     *
     * @param \GestionBudgetBundle\Entity\Compte $compte
     *
     * @return Chapitre
     */
    public function addCompte(\GestionBudgetBundle\Entity\Compte $compte)
    {
        $this->comptes[] = $compte;

        return $this;
    }

    /**
     * Remove compte
     *
     * @param \GestionBudgetBundle\Entity\Compte $compte
     */
    public function removeCompte(\GestionBudgetBundle\Entity\Compte $compte)
    {
        $this->comptes->removeElement($compte);
    }

    /**
     * Get comptes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComptes()
    {
        return $this->comptes;
    }
}
