<?php

namespace Punnet\SiteBundle\Entity\Departement;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Departement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Punnet\SiteBundle\Entity\Departement\DepartementRepository")
 */
class Departement
{
	
	/**
     * @ORM\ManyToOne(targetEntity="Punnet\SiteBundle\Entity\Region\Region")
     * @ORM\JoinColumn(nullable = false)
     */
    private $region;
    
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
     * @ORM\Column(name="Departement", type="string", length=255)
     */
    private $departement;
    
    /**
	* @Gedmo\Slug(fields={"departement"})
	* @ORM\Column(length=128, unique=true)
	*/
	private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="Numero", type="string", length=255)
     */
    private $numero;

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
     * Set departement
     *
     * @param string $departement
     * @return Departement
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Departement
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set region
     *
     * @param \Punnet\SiteBundle\Entity\Region\Region $region
     * @return Departement
     */
    public function setRegion(\Punnet\SiteBundle\Entity\Region\Region $region)
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
     * Set slug
     *
     * @param string $slug
     * @return Departement
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
