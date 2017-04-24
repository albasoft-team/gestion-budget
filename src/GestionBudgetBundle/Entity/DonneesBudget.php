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
     * @ORM\Column(name="BudgetDemande", type="float")
     */
    private $budgetDemande;

    /**
     * @var float
     *
     * @ORM\Column(name="BudgetVote", type="float")
     */
    private $budgetVote;

    /**
     * @var float
     *
     * @ORM\Column(name="Budgetrecouvre", type="float")
     */
    private $budgetrecouvre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateSaisie", type="date")
     */
    private $dateSaisie;

    /**
     * @ORM\OneToOne(targetEntity="Compte", mappedBy="donneesbudget")
     */
    private $compte;

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
}
