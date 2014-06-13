<?php 
// src/Punnet\SiteBundle/DataFixtures/ORM/Annonce/LoadAnnonceData.php

namespace Punnet\SiteBundle\DataFixtures\ORM\Abonnement;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Punnet\SiteBundle\Entity\Abonnement\UserAbonnement;

class LoadUserAbonnementData extends AbstractFixture implements OrderedFixtureInterface
{
   /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	
    	// Creation des categories Multimédia
		$userAbonnement  = $this->createUserAbonnement( $this->getReference('user-1'), $this->getReference('user-2'), TRUE );
										 								 							 
		// Enregistrement des annonces
		$manager->persist($userAbonnement);
		$manager->flush();
	}	
			
	
	// Fonction de création globale
	private function createUserAbonnement($user, $follower, $enabled) {
	
		$userAbonnement = new  UserAbonnement();
		$userAbonnement->setUser($user)
					   ->setFollower($follower)
					   ->setEnabled($enabled);
 
		return $userAbonnement;
	}
	
	public function getOrder()
	{
		return 7; 
	} 

}