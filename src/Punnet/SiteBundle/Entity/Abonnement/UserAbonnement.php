<?php

namespace Punnet\SiteBundle\Entity\Abonnement;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAbonnement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Punnet\SiteBundle\Entity\Abonnement\UserAbonnementRepository")
 */
class UserAbonnement
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

	// Qui est l'auteur
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\UserBundle\Entity\User")
    */
	private $user; 

    // Qui est le follower
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\UserBundle\Entity\User")
    */
    private $follower;

	
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
     * @return UserAbonnement
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
     * @return UserAbonnement
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
     * @return UserAbonnement
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
     * Set follower
     *
     * @param \Punnet\UserBundle\Entity\User $follower
     * @return UserAbonnement
     */
    public function setFollower(\Punnet\UserBundle\Entity\User $follower = null)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get follower
     *
     * @return \Punnet\UserBundle\Entity\User 
     */
    public function getFollower()
    {
        return $this->follower;
    }
}
