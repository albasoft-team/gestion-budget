<?php

namespace GestionBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departement
 *
 * @ORM\Table(name="departement")
 * @ORM\Entity(repositoryClass="GestionBudgetBundle\Repository\DepartementRepository")
 */
class Departement
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
     * @ORM\Column(name="nomDepartement", type="string", length=255)
     */
    private $nomDepartement;

    /**
     * @ORM\OneToMany(targetEntity="Commune", mappedBy="departement")
     */
    private $communes;

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="departements")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    private $region;



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
     * Set nomDepartement
     *
     * @param string $nomDepartement
     *
     * @return Departement
     */
    public function setNomDepartement($nomDepartement)
    {
        $this->nomDepartement = $nomDepartement;

        return $this;
    }

    /**
     * Get nomDepartement
     *
     * @return string
     */
    public function getNomDepartement()
    {
        return $this->nomDepartement;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->communes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commune
     *
     * @param \GestionBudgetBundle\Entity\Commune $commune
     *
     * @return Departement
     */
    public function addCommune(\GestionBudgetBundle\Entity\Commune $commune)
    {
        $this->communes[] = $commune;

        return $this;
    }

    /**
     * Remove commune
     *
     * @param \GestionBudgetBundle\Entity\Commune $commune
     */
    public function removeCommune(\GestionBudgetBundle\Entity\Commune $commune)
    {
        $this->communes->removeElement($commune);
    }

    /**
     * Get communes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommunes()
    {
        return $this->communes;
    }

    /**
     * Set region
     *
     * @param \GestionBudgetBundle\Entity\Region $region
     *
     * @return Departement
     */
    public function setRegion(\GestionBudgetBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \GestionBudgetBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

}
