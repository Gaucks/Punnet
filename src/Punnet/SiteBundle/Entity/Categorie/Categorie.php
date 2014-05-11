<?php

namespace Punnet\SiteBundle\Entity\Categorie;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Punnet\SiteBundle\Entity\Categorie\CategorieRepository")
 */
class Categorie
{    
	/**
     * @ORM\ManyToOne(targetEntity="Punnet\SiteBundle\Entity\ParentCategorie\ParentCategorie", cascade={"persist"}))
     * @ORM\JoinColumn(nullable = false)
     */
    private $parentcategorie;
    
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
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

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
     * Set categorie
     *
     * @param string $categorie
     * @return Categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set parentcategorie
     *
     * @param \Punnet\SiteBundle\Entity\ParentCategorie\ParentCategorie $parentcategorie
     * @return Categorie
     */
    public function setParentcategorie(\Punnet\SiteBundle\Entity\ParentCategorie\ParentCategorie $parentcategorie)
    {
        $this->parentcategorie = $parentcategorie;

        return $this;
    }

    /**
     * Get parentcategorie
     *
     * @return \Punnet\SiteBundle\Entity\ParentCategorie\ParentCategorie
     */
    public function getParentcategorie()
    {
        return $this->parentcategorie;
    }
}
