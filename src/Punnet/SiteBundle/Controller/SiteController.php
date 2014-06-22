<?php

namespace Punnet\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Punnet\SiteBundle\Entity\Annonce\Annonce;
use Punnet\SiteBundle\Form\Type\Annonce\PunnetAnnonceType;
use Punnet\SiteBundle\Form\Handler\PunnetAnnonceHandler;
use Symfony\Component\HttpFoundation\Request;

class SiteController extends Controller
{
	// Affiche la page du Coming Soon
    public function comingSoonAction()
    {
        return $this->render('PunnetSiteBundle:ComingSoon:comingsoon.html.twig');
    }
    
    // Affiche le menu d'une annonce
    public function menuAnnonceAction($annonce = NULL, $menutype = NULL, $request_region = NULL)
    {	
    	if($menutype 	 == "showAnnonce"){
	    	return $this->render('PunnetSiteBundle:Menu:menuShowAnnonce.html.twig', array('annonceur' => $annonce));
    	}
    	
    	elseif($menutype == "showAllUserAnnonce"){
	    	return $this->render('PunnetSiteBundle:Menu:menushowAllUserAnnonce.html.twig', array('annonceur' => $annonce));
    	}
    	
    	elseif($menutype == "menuregion"){
    		
    		
    		$em = $this->getDoctrine()->getManager();
    		$slug = $em->getRepository('PunnetSiteBundle:Region\Region')->findOneByRegion($request_region);
    		
    		if(!$slug){ $slug_region = 'toutes-les-regions'; } else { $slug_region = $slug->getSlug(); }
    		
	    	return $this->render('PunnetSiteBundle:Menu:menu.html.twig', array('request_region' => $request_region, 
	    																	   'slug_region' 	=> $slug_region));
    	}
    	
    	else{
	    	throw $this->createNotFoundException('Il y a un probleme avec le menu.');
    	}
		
    }
    
    // Affiche la page d'accueil
    public function accueilAction()
    {	
    	$em = $this->getDoctrine()->getManager();
    	$regions = $em->getRepository('PunnetSiteBundle:Region\Region')->findAll();
    	
	    return $this->render('PunnetSiteBundle:Site:accueil.html.twig', array('regions' => $regions));
    }
    
    // Affiche l'annonce demandée
    public function showAnnonceAction($annonce)
    {
    	
    	$annonce = $this->getDoctrine()->getManager()->getRepository('PunnetSiteBundle:Annonce\Annonce')->findOneBy(array('slug' =>$annonce));
		
		if(!$annonce){
			throw $this->createNotFoundException('L\'annonce n\'existe pas, vous avez du faire une erreur.');
		}
    	
	    return $this->render('PunnetSiteBundle:Site:Annonce/showAnnonce.html.twig', array('showannonce'    => TRUE,
	    																				  'menutype'	   => 'showAnnonce',
	    																				  'annonce'        => $annonce, 																									  	      'request_region' => $annonce->getRegion()->getRegion()));
    }
    
    // Affiche la page d'accueil d'un utilisateur
    public function showUserAction()
    {
	   return $this->render('PunnetSiteBundle:Site:showUser.html.twig'); 
    }
    
    // Affiche l'accueil d'une région
    public function showRegionAction(Request $request, $region )
    {
    	$em = $this->getDoctrine()->getManager();	
    	$em_region = $em->getRepository('PunnetSiteBundle:Region\Region');
    	$region_exist = $em_region->findOneBySlug($region);
    	
    	if( $region_exist ){
	    	
	    	$query = $request->query->get('order');
	    	// On récupere les annonces de la régions concerné
	    	$annonce = $this->getAnnonceOrderBy($region_exist->getId(), $query , $em);
	    	
			// On recupere le nom normal de la région
			$request_region  = $em_region->findOneBySlug($region);
			$request_region  = $request_region->getRegion();
    	}
    	else{
    		if($region != "toutes-les-regions"){
	    		return $this->redirect($this->generateUrl('punnet_showRegion', array('region' => 'toutes-les-regions')));
    		}
	    	$annonce		 = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->findAll();
			$request_region  = "Toutes les régions";
    	}
    	
		
		return $this->render('PunnetSiteBundle:Site:Region/showRegion.html.twig', array('menu'           => 'region', 
																						'region'         => $region,
																						'showannonce'    => FALSE,
																						'defaut_menu' 	 => TRUE,
																						'menutype'	   	 => 'menuregion',
																						'request_region' => $request_region,
																						'annonce' 		 => $annonce));	
	} 
    
    // Affiche l'accueil d'une région
    public function showAllUserAnnonceAction($user)
    {
    	$em = $this->getDoctrine()->getManager();	
    	
    	// Recherche l'existence de l'utilisateur en question
    	$user = $em->getRepository('PunnetUserBundle:User')->find($user);
    	
    	if(!$user){
	    	throw $this->createNotFoundException('L\'utilisateur n\'existe pas, vous avez du faire une erreur.');
    	}
    	
		$annonce = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->findBy(array('user' => $user));    	
		
		return $this->render('PunnetSiteBundle:Site:showAllUserAnnonce.html.twig', array( 
																						'liste'      	 => $annonce,
																						'menutype'	   	 => 'showAllUserAnnonce',
																						'request_region' => $user->getUsername(),
																						'annonce' 	 	 => $user ));	
	}
    
    public function getAnnonceOrderBy($region, $order, $em)
    {
		if($order == 'dateAsc' or $order == NULL)
		{
			$annonce = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->findBy( array('region' => $region), 
																					   array('date'   => 'ASC'));
		}
		if($order == 'dateDesc')
		{
			$annonce = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->findBy( array('region' => $region), 
																					   array('date'   => 'DESC'));
		}
		if($order == 'priceAsc' ){
			$annonce = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->getByPrice($region, 'ASC');
		}
		if($order == 'priceDesc' ){
			$annonce = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->getByPrice($region, 'DESC');
		}
		return $annonce;
    }    
}
