<?php

namespace Punnet\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Punnet\SiteBundle\Entity\Annonce\Annonce;
use Punnet\SiteBundle\Form\Type\Annonce\PunnetAnnonceType;

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
	    return $this->render('PunnetSiteBundle:Site:Annonce/showAnnonce.html.twig', array('menu' => 'annonce'));
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
    
    // Affiche la page de dépose d'annonce
    public function depotAnnonceAction()
    {
    	$securityContext = $this->container->get('security.context'); // Le conttroleur de sécurité
    	
    	if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
    		return $this->redirect($this->generateUrl('fos_user_security_login'));
    	}
	    	$annonce = new Annonce;
	    	
	    	$user	= $securityContext->getToken()->getUser();
	    	
	    	$annonce = $annonce->setDepartement($user->getDepartement())
	    					   ->setRegion($user->getRegion())
	    					   ->setVille($user->getVille());
	    	
			$form = $this->createForm(new PunnetAnnonceType(), $annonce);
	    	
		   return $this->render('PunnetSiteBundle:Depot:annonce.html.twig', array('form' => $form->createView(), 'depot' => TRUE));
    }
    
}
