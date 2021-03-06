<?php

namespace GestionBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="GestionBudgetBundle\Repository\RegionRepository")
 */
class Region
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
     * @ORM\Column(name="nomRegion", type="string", length=255)
     */
    private $nomRegion;

    /**
         * @var string
         *
         * @ORM\Column(name="codeRegion", type="string", length=255)
         */
        private $codeRegion;


    /**
     * @ORM\OneToMany(targetEntity="Departement", mappedBy="region")
     */
    private $departements;

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
     * Set nomRegion
     *
     * @param string $nomRegion
     *
     * @return Region
     */
    public function setNomRegion($nomRegion)
    {
        $this->nomRegion = $nomRegion;

        return $this;
    }

    /**
     * Get nomRegion
     *
     * @return string
     */
    public function getNomRegion()
    {
        return $this->nomRegion;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add departement
     *
     * @param \GestionBudgetBundle\Entity\Departement $departement
     *
     * @return Region
     */
    public function addDepartement(\GestionBudgetBundle\Entity\Departement $departement)
    {
        $this->departements[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \GestionBudgetBundle\Entity\Departement $departement
     */
    public function removeDepartement(\GestionBudgetBundle\Entity\Departement $departement)
    {
        $this->departements->removeElement($departement);
    }

    /**
     * Get departements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartements()
    {
        return $this->departements;
    }


    /**
     * Set codeRegion
     *
     * @param string $codeRegion
     *
     * @return Region
     */
    public function setCodeRegion($codeRegion)
    {
        $this->codeRegion = $codeRegion;

        return $this;
    }

    /**
     * Get codeRegion
     *
     * @return string
     */
    public function getCodeRegion()
    {
        return $this->codeRegion;
    }
}
