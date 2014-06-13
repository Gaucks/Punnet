<?php 
// src/Punnet\SiteBundle/DataFixtures/ORM/Annonce/LoadAnnonceData.php

namespace Punnet\SiteBundle\DataFixtures\ORM\Abonnement;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Punnet\SiteBundle\Entity\Abonnement\RegionAbonnement;

class LoadRegionAbonnementData extends AbstractFixture implements OrderedFixtureInterface
{
   /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	
    	// Creation des categories Multimédia
		$regionAbonnement  = $this->createRegionAbonnement( $this->getReference('user-1'), $this->getReference('region-pa'), TRUE );
										 								 							 
		// Enregistrement des annonces
		$manager->persist($regionAbonnement);
		$manager->flush();
	}	
			
	
	// Fonction de création globale
	private function createRegionAbonnement($user, $region, $enabled) {
	
		$regionAbonnement = new  RegionAbonnement();
		$regionAbonnement->setUser($user)
					   	 ->setRegion($region)
					   	 ->setEnabled($enabled);
 
		return $regionAbonnement;
	}
	
	public function getOrder()
	{
		return 8; 
	} 

}