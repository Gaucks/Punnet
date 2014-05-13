<?php 
// src/Punnet\SiteBundle/DataFixtures/ORM/Annonce/LoadAnnonceData.php

namespace Punnet\SiteBundle\DataFixtures\ORM\Annonce;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Punnet\SiteBundle\Entity\Annonce\Annonce;

class LoadAnnonceData extends AbstractFixture implements OrderedFixtureInterface
{
   /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    
    	$lorem = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 				  aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 				  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 				  occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    	
    	$image1 = "mini.jpeg";
    	$image2 = "ferrari.jpeg";
    	$image3 = "imac.png";
    	$image4 = "photo.jpg";
    	$image5 = "ordi.jpeg";
    	$image6 = "concert.jpeg";
    	$image7 = "porshe.jpeg";
    	$image8 = "tel.jpeg";
    	
    	
    	
    	
    	// Creation des categories Multimédia
		$annonce1  = $this->createAnnonce('Une premiere annonce',
										 $lorem, 
										 NULL,
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image1);
										 
	    $annonce2  = $this->createAnnonce('Imac 21" de 2011 sans accessoires',
										 $lorem, 
										 '1120',
										 $this->getReference('categorie-2'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image2);
										 
		$annonce3  = $this->createAnnonce('MacBook Pro 2012 13Pouces',
										 $lorem, 
										 '1000',
										 $this->getReference('categorie-3'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image3);
										 
	    $annonce4  = $this->createAnnonce('Chambre de 10m2 avec balcon',
										 $lorem, 
										 '10',
										 $this->getReference('categorie-4'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image4);
		
		$annonce5  = $this->createAnnonce('Téléphone portable Iphone 4S niquel',
										 $lorem, 
										 '3200',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image8);
										 
	    $annonce6  = $this->createAnnonce('Un titre d\'annonce je sais pas',
										 $lorem, 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image5);
		
		$annonce7  = $this->createAnnonce('Une porsche 911 cabriolet noir parfait état !',
										 $lorem, 
										 NULL,
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image4);
										 
	    $annonce8  = $this->createAnnonce('Montre à quartz en parfait état',
										 $lorem, 
										 '50',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image6);
										 
		$annonce9  = $this->createAnnonce('Opel Corsa bleu',
										 $lorem, 
										 '100000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image2);
										 
	    $annonce10  = $this->createAnnonce('10 CD d\'Elvis presley !',
										 $lorem, 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image7);
		
		$annonce11  = $this->createAnnonce('Une annonce basic 11',
										 $lorem, 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image6);
										 
	    $annonce12  = $this->createAnnonce('Canapé d\'angle 6 places taupe',
										 $lorem, 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'),
										 $image5);
										 								 							 
		// Enregistrement des annonces
		$manager->persist($annonce1);
		$manager->persist($annonce2);
		$manager->persist($annonce3);
		$manager->persist($annonce4);
		$manager->persist($annonce5);
		$manager->persist($annonce6);
		$manager->persist($annonce7);
		$manager->persist($annonce8);
		$manager->persist($annonce9);
		$manager->persist($annonce10);
		$manager->persist($annonce11);
		$manager->persist($annonce12);
		
		
		$manager->flush();
	}	
			
	
	// Fonction de création globale
	private function createAnnonce($title, $description, $price, $categorie, $user, $region, $departement, $ville, $image) {
	
		$annonce = new  Annonce();
		$annonce->setTitle($title)
				->setDescription($description)
				->setRegion($region)
				->setDepartement($departement)
				->setVille($ville)
				->setPrice($price)
				->setCategorie($categorie)
				->setUser($user)
				->setImage($image);
 
		return $annonce;
	}
	
	public function getOrder()
	{
		return 6; 
	} 

}