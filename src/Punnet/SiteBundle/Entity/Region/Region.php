<?php

namespace Punnet\SiteBundle\Entity\Region;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Punnet\SiteBundle\Entity\Region\RegionRepository")
 */
class Region
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
	 * @var string
	 *
	 * @ORM\Column(name="region", type="string", length=128)
	 */
	 private $region;

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
     * @param string $region
     * @return Region
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }
}
