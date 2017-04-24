<?php
/**
 * Created by PhpStorm.
 * User: ALY
 * Date: 24/04/2017
 * Time: 13:40
 */

namespace GestionBudgetBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nom;

    /**
     * @ORM\Column(type="string")
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string")
     */
    protected $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="users")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    private $region;
    /**
     * @ORM\ManyToOne(targetEntity="Departement", inversedBy="users")
     * @ORM\JoinColumn(name="departement_id", referencedColumnName="id")
     */
    private $departement;
    /**
     * @ORM\ManyToOne(targetEntity="Commune", inversedBy="users")
     * @ORM\JoinColumn(name="commune_id", referencedColumnName="id")
     */
    private $commune;



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Set nom
     *
     * @param \adresse $nom
     *
     * @return User
     */
    public function setNom(\adresse $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return \adresse
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set commune
     *
     * @param \GestionBudgetBundle\Entity\Commune $commune
     *
     * @return User
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
     * Set region
     *
     * @param \GestionBudgetBundle\Entity\Region $region
     *
     * @return User
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

    /**
     * Set departement
     *
     * @param \GestionBudgetBundle\Entity\Departement $departement
     *
     * @return User
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
