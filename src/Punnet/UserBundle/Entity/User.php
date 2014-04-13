<?php
namespace Punnet\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
 	// DANS QUEL REGION IL SE SITUE
    /**
    * @ORM\ManyToOne(targetEntity="Punnet\SiteBundle\Entity\Region\Region")
    */
	private  $region;

	// Quel département
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\SiteBundle\Entity\Departement\Departement")
    */
	private $departement;

	// Quel ville
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\SiteBundle\Entity\Ville\Ville")
    */
	private $ville;
		
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set region
     *
     * @param \Punnet\SiteBundle\Entity\Region\Region $region
     * @return User
     */
    public function setRegion(\Punnet\SiteBundle\Entity\Region\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Punnet\SiteBundle\Entity\Region\Region 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set departement
     *
     * @param \Punnet\SiteBundle\Entity\Departement\Departement $departement
     * @return User
     */
    public function setDepartement(\Punnet\SiteBundle\Entity\Departement\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \Punnet\SiteBundle\Entity\Departement\Departement 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set ville
     *
     * @param \Punnet\SiteBundle\Entity\Ville\Ville $ville
     * @return User
     */
    public function setVille(\Punnet\SiteBundle\Entity\Ville\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Punnet\SiteBundle\Entity\Ville\Ville 
     */
    public function getVille()
    {
        return $this->ville;
    }
}
