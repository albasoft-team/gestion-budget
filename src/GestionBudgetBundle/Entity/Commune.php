<?php

namespace GestionBudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commune
 *
 * @ORM\Table(name="commune")
 * @ORM\Entity(repositoryClass="GestionBudgetBundle\Repository\CommuneRepository")
 */
class Commune
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
     * @ORM\Column(name="nomCommune", type="string", length=255)
     */
    private $nomCommune;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="region")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Departement", inversedBy="communes")
     * @ORM\JoinColumn(name="departement_id", referencedColumnName="id")
     */
    private $departement;

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
     * Set nomCommune
     *
     * @param string $nomCommune
     *
     * @return Commune
     */
    public function setNomCommune($nomCommune)
    {
        $this->nomCommune = $nomCommune;

        return $this;
    }

    /**
     * Get nomCommune
     *
     * @return string
     */
    public function getNomCommune()
    {
        return $this->nomCommune;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \GestionBudgetBundle\Entity\User $user
     *
     * @return Commune
     */
    public function addUser(\GestionBudgetBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \GestionBudgetBundle\Entity\User $user
     */
    public function removeUser(\GestionBudgetBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set departement
     *
     * @param \GestionBudgetBundle\Entity\Departement $departement
     *
     * @return Commune
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
}
