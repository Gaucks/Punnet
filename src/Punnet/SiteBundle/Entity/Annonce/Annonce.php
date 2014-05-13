<?php

namespace Punnet\SiteBundle\Entity\Annonce;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// On rajoute ce use pour le context ( le callback pour le titre ):
use Symfony\Component\Validator\ExecutionContextInterface;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Annonce
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Punnet\SiteBundle\Entity\Annonce\AnnonceRepository")
 * @Assert\Callback(methods={"ValidTitle"})
 */
class Annonce
{

	// Qui est l'auteur
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\UserBundle\Entity\User")
    */
	private $user;
	
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
	
	// Quel Categorie
	/**
    * @ORM\ManyToOne(targetEntity="Punnet\SiteBundle\Entity\Categorie\Categorie")
    */
	private $categorie;
	
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;
    
    /**
    * @var string
    *
    * @ORM\Column(name="ipadress", nullable=true)
    */
    private $ipadress;
    
    /**
	* @Gedmo\Slug(fields={"title"})
	* @ORM\Column(length=256)
	*/
	private $slug;
	
	 /**
    * @var string
    *
    * @ORM\Column(name="image", nullable=true)
    */
	private $image;

	
	public function __construct()
	{
		$this->date  = new \DateTime();
		$this->updated  = new \DateTime(); 	
	}
	
	public function ValidTitle(ExecutionContextInterface $context)
     {
	    $mots_interdits = array('Vend', 'Vends', 'Achete', 'achete', 'donne');
	    
	    // On vérifie que le contenu ne contient pas l'un des mots
		if (preg_match('#'.implode('|', $mots_interdits).'#', $this->getTitle())) 
		{
			// La règle est violée, on définit l'erreur et son message
			// 1er argument : on dit quel attribut l'erreur concerne, ici « contenu »
			// 2e argument : le message d'erreur
			$context->addViolationAt('title', 'Veuillez ne pas inclure " vends, achete ou donne " dans votre titre.', array(), null);
		}
	    
	    
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
     * Set title
     *
     * @param string $title
     * @return Annonce
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Annonce
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
     * Set description
     *
     * @param string $description
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Annonce
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Annonce
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Annonce
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }
	
	/**
     * Set user
     *
     * @param \Punnet\UserBundle\Entity\User $user
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * Set categorie
     *
     * @param \Punnet\SiteBundle\Entity\Categorie\Categorie $categorie
     * @return Annonce
     */
    public function setCategorie(\Punnet\SiteBundle\Entity\Categorie\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Punnet\SiteBundle\Entity\Categorie\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    
    /**
     * Set ipadress
     *
     * @param string $ipadress
     * @return Annonce
     */
    public function setIpadress($ipadress)
    {
        $this->ipadress = $ipadress;

        return $this;
    }

    /**
     * Get ipadress
     *
     * @return string 
     */
    public function getIpadress()
    {
        return $this->ipadress;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Annonce
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

    /**
     * Set image
     *
     * @param string $image
     * @return Annonce
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
