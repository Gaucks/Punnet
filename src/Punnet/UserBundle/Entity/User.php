<?php
namespace Punnet\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true )
     */
    private $surname;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showphone", type="string")
     */
    private $showphone;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @var string
     * @ORM\Column(name="avatar",type="string", nullable=true)
     */
    private $avatar;
	
	/**
	* @Assert\File(maxSize="6000000")
	*/
	private $file;

	public function __construct()
	{
		parent::__construct();
		$this->showphone = 1;
		$this->avatar    = "no_avatar.png";
	}
	
	public function upload()
	{
		// Si jamais il n'y a pas de fichier (champ facultatif)
		if (null === $this->file) {
		  return;
		}
		
		// On garde le nom original du fichier de l'internaute
		$name = $this->file->getClientOriginalName();
		
		// On déplace le fichier envoyé dans le répertoire de notre choix
		$this->file->move($this->getUploadRootDir(), $name);
		
		
		// On crée également le futur attribut alt de notre balise <img>
		$this->avatar = $name;
	}
	
	public function getUploadDir()
	{
		// On retourne le chemin relatif vers l'image pour un navigateur
		return 'uploads/img';
	}
	
	protected function getUploadRootDir()
	{
		// On retourne le chemin relatif vers l'image pour notre code PHP
		return __DIR__.'/../../../../web/'.$this->getUploadDir();
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set showphone
     *
     * @param boolean $showphone
     * @return User
     */
    public function setShowphone($showphone)
    {
        $this->showphone = $showphone;

        return $this;
    }

    /**
     * Get showphone
     *
     * @return boolean 
     */
    public function getShowphone()
    {
        return $this->showphone;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
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

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    
    public function getFile()
	{
	    return $this->file;
	}
	
	// On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
	public function setFile( $file)
	{
	    $this->file = $file;
	    
	    return $this;
	
	 }
}
