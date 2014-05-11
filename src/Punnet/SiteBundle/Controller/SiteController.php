<?php

namespace Punnet\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Punnet\SiteBundle\Entity\Annonce\Annonce;
use Punnet\SiteBundle\Form\Type\Annonce\PunnetAnnonceType;
use Punnet\SiteBundle\Form\Handler\PunnetAnnonceHandler;

class SiteController extends Controller
{
	// Affiche la page du Coming Soon
    public function comingSoonAction()
    {
        return $this->render('PunnetSiteBundle:ComingSoon:comingsoon.html.twig');
    }
    
    // Affiche le menu
    public function menuAction()
    {
		return $this->render('PunnetSiteBundle:Menu:menu.html.twig');
    }
    
    // Affiche le menu
    public function menuShowAnnonceAction($annonce)
    {
		$annonceur = $this->getDoctrine()->getManager()->getRepository('PunnetSiteBundle:Annonce\Annonce')->find($annonce);
		
		return $this->render('PunnetSiteBundle:Menu:menuShowAnnonce.html.twig', 
												array('annonceur' => $annonceur));
    }
    
    // Affiche la page d'accueil
    public function accueilAction()
    {	
    	$em = $this->getDoctrine()->getManager();
    	$regions = $em->getRepository('PunnetSiteBundle:Region\Region')->findAll();
    	
	    return $this->render('PunnetSiteBundle:Site:accueil.html.twig', array('regions' => $regions));
    }
    
    // Affiche l'annonce demandée
    public function showAnnonceAction()
    {
	    return $this->render('PunnetSiteBundle:Site:Annonce/showAnnonce.html.twig', array('showannonce' => TRUE, 'annonce' => 1));
    }
    
    // Affiche la page d'accueil d'un utilisateur
    public function showUserAction()
    {
	   return $this->render('PunnetSiteBundle:Site:showUser.html.twig'); 
    }
    
    // Affiche l'accueil d'une région
    public function showRegionAction()
    {
		return $this->render('PunnetSiteBundle:Site:Region/showRegion.html.twig', array('menu' => 'region'));	
	}    
}
