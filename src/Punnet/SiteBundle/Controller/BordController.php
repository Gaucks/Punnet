<?php

namespace Punnet\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BordController extends Controller
{
 	 // Affiche la page d'accueil du membre
	public function showUserBordAction()
	{	
    	return $this->render('PunnetSiteBundle:Bord:UserBord/UserBord.html.twig', array());	
	}
	
	// Affiche la page des annonces
	public function showUserAnnonceAction()
	{
		return $this->render('PunnetSiteBundle:Bord:Annonce/UserAnnonce.html.twig', array());
	}
	  
}
