<?php

namespace GestionBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DonneesBudget
 *
 * @ORM\Table(name="donnees_budget")
 * @ORM\Entity(repositoryClass="GestionBudgetBundle\Repository\DonneesBudgetRepository")
 */
class DonneesBudget
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
     * @var float
     *
     * @ORM\Column(name="BudgetDemande", nullable=true, type="float")
     */
    private $budgetDemande;

    /**
     * @var float
     *
     * @ORM\Column(name="BudgetVote", nullable=true, type="float")
     */
    private $budgetVote;

    /**
     * @var float
     *
     * @ORM\Column(name="Budgetrecouvre", nullable=true, type="float")
     */
    private $budgetrecouvre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateSaisie", type="date")
     */
    private $dateSaisie;
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="$dateModifiee", nullable=true, type="date")
     */
    private $dateModifiee;



    /**
     * @ORM\OneToOne(targetEntity="Compte", inversedBy="donneesbudget")
     * @ORM\JoinColumn(name="compte_id", referencedColumnName="id")
     */
    private $compte;
    /**
     * @ORM\ManyToOne(targetEntity="GestionBudgetBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="GestionBudgetBundle\Entity\Departement")
     * @ORM\JoinColumn(name="departement_id", referencedColumnName="id")
     */
    private $departement;
    /**
     * @ORM\ManyToOne(targetEntity="GestionBudgetBundle\Entity\Commune")
     * @ORM\JoinColumn(name="commune_id", referencedColumnName="id")
     */
    private $commune;

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
     * Set budgetDemande
     *
     * @param float $budgetDemande
     *
     * @return DonneesBudget
     */
    public function setBudgetDemande($budgetDemande)
    {
        $this->budgetDemande = $budgetDemande;

        return $this;
    }

    /**
     * Get budgetDemande
     *
     * @return float
     */
    public function getBudgetDemande()
    {
        return $this->budgetDemande;
    }

    /**
     * Set budgetVote
     *
     * @param float $budgetVote
     *
     * @return DonneesBudget
     */
    public function setBudgetVote($budgetVote)
    {
        $this->budgetVote = $budgetVote;

        return $this;
    }

    /**
     * Get budgetVote
     *
     * @return float
     */
    public function getBudgetVote()
    {
        return $this->budgetVote;
    }

    /**
     * Set budgetrecouvre
     *
     * @param float $budgetrecouvre
     *
     * @return DonneesBudget
     */
    public function setBudgetrecouvre($budgetrecouvre)
    {
        $this->budgetrecouvre = $budgetrecouvre;

        return $this;
    }

    /**
     * Get budgetrecouvre
     *
     * @return float
     */
    public function getBudgetrecouvre()
    {
        return $this->budgetrecouvre;
    }

    /**
     * Set dateSaisie
     *
     * @param \DateTime $dateSaisie
     *
     * @return DonneesBudget
     */
    public function setDateSaisie($dateSaisie)
    {
        $this->dateSaisie = $dateSaisie;

        return $this;
    }

    /**
     * Get dateSaisie
     *
     * @return \DateTime
     */
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }


    /**
     * Set compte
     *
     * @param \GestionBudgetBundle\Entity\Compte $compte
     *
     * @return DonneesBudget
     */
    public function setCompte(\GestionBudgetBundle\Entity\Compte $compte = null)
    {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get compte
     *
     * @return \GestionBudgetBundle\Entity\Compte
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * Set user
     *
     * @param \GestionBudgetBundle\Entity\User $user
     *
     * @return DonneesBudget
     */
    public function setUser(\GestionBudgetBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \GestionBudgetBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set departement
     *
     * @param \GestionBudgetBundle\Entity\Departement $departement
     *
     * @return DonneesBudget
     */
    public function setDepartement(\GestionBudgetBundle\Entity\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \GestionBudgetBundle\Entity\Departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set commune
     *
     * @param \GestionBudgetBundle\Entity\Commune $commune
     *
     * @return DonneesBudget
     */
    public function setCommune(\GestionBudgetBundle\Entity\Commune $commune = null)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return \GestionBudgetBundle\Entity\Commune
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set dateModifiee
     *
     * @param \DateTime $dateModifiee
     *
     * @return DonneesBudget
     */
    public function setDateModifiee($dateModifiee)
    {
        $this->dateModifiee = $dateModifiee;

        return $this;
    }

    /**
     * Get dateModifiee
     *
     * @return \DateTime
     */
    public function getDateModifiee()
    {
        return $this->dateModifiee;
    }
}
