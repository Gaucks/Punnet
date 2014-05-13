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
    	// Creation des categories Multimédia
		$annonce1  = $this->createAnnonce('Une annonce basic',
										 'Une description', 
										 NULL,
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 
	    $annonce2  = $this->createAnnonce('Une annonce basic 2',
										 'Une description', 
										 '1020',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
		$annonce3  = $this->createAnnonce('Une annonce basic 3',
										 'Une description', 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 
	    $annonce4  = $this->createAnnonce('Une annonce basic 4',
										 'Une description', 
										 '10',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
		
		$annonce5  = $this->createAnnonce('Une annonce basic 5',
										 'Une description', 
										 '3200',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 
	    $annonce6  = $this->createAnnonce('Une annonce basic 6',
										 'Une description', 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
		
		$annonce7  = $this->createAnnonce('Une annonce basic 7',
										 'Une description', 
										 NULL,
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 
	    $annonce8  = $this->createAnnonce('Une annonce basic 8',
										 'Une description', 
										 '50',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 
		$annonce9  = $this->createAnnonce('Une annonce basic 9',
										 'Une description', 
										 '100000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 
	    $annonce10  = $this->createAnnonce('Une annonce basic 10',
										 'Une description', 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
		
		$annonce11  = $this->createAnnonce('Une annonce basic 11',
										 'Une description', 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 
	    $annonce12  = $this->createAnnonce('Une annonce basic 12',
										 'Une description', 
										 '1000',
										 $this->getReference('categorie-1'), 
										 $this->getReference('user-1'), 
										 $this->getReference('region-pa'), 
										 $this->getReference('departement-var'), 
										 $this->getReference('ville-vin'));
										 								 							 
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
	private function createAnnonce($title, $description, $price, $categorie, $user, $region, $departement, $ville) {
	
		$annonce = new  Annonce();
		$annonce->setTitle($title)
				->setDescription($description)
				->setRegion($region)
				->setDepartement($departement)
				->setVille($ville)
				->setPrice($price)
				->setCategorie($categorie)
				->setUser($user);
 
		return $annonce;
	}
	
	public function getOrder()
	{
		return 6; 
	} 

}