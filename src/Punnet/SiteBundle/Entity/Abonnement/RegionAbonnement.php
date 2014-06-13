<?php

namespace Punnet\SiteBundle\Entity\Abonnement;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegionAbonnement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Punnet\SiteBundle\Entity\Abonnement\RegionAbonnementRepository")
 */
class RegionAbonnement
{	
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

	// Qui est le follower
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\UserBundle\Entity\User")
    */
	private $user; 

    // Quelle est la région suivi
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\SiteBundle\Entity\Region\Region")
    */
    private $region;
	
	public function __construct()
	{
		$this->date = new \DateTime();
		$this->enabled = true;
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
     * Set date
     *
     * @param \DateTime $date
     * @return RegionAbonnement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return RegionAbonnement
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set user
     *
     * @param \Punnet\UserBundle\Entity\User $user
     * @return RegionAbonnement
     */
    public function setUser(\Punnet\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Punnet\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set region
     *
     * @param \Punnet\SiteBundle\Entity\Region\Region $region
     * @return RegionAbonnement
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
}
