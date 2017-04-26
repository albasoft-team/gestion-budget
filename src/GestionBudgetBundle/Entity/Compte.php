<?php

namespace GestionBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte
 *
 * @ORM\Table(name="compte")
 * @ORM\Entity(repositoryClass="GestionBudgetBundle\Repository\CompteRepository")
 */
class Compte
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroCompte", type="string", length=255)
     */
    private $numeroCompte;

    /**
     * @ORM\ManyToOne(targetEntity="Chapitre", inversedBy="comptes")
     * @ORM\JoinColumn(name="chapitre_id", referencedColumnName="id")
     */
    private $chapitre;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Compte
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set numeroCompte
     *
     * @param string $numeroCompte
     *
     * @return Compte
     */
    public function setNumeroCompte($numeroCompte)
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }

    /**
     * Get numeroCompte
     *
     * @return string
     */
    public function getNumeroCompte()
    {
        return $this->numeroCompte;
    }

    /**
     * Set chapitre
     *
     * @param \GestionBudgetBundle\Entity\Chapitre $chapitre
     *
     * @return Compte
     */
    public function setChapitre(\GestionBudgetBundle\Entity\Chapitre $chapitre = null)
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    /**
     * Get chapitre
     *
     * @return \GestionBudgetBundle\Entity\Chapitre
     */
    public function getChapitre()
    {
        return $this->chapitre;
    }

}
