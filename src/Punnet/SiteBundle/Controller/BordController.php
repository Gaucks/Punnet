<?php

namespace Punnet\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Punnet\SiteBundle\Entity\Annonce\Annonce;
use Punnet\SiteBundle\Form\Type\Annonce\PunnetAnnonceType;
use Punnet\SiteBundle\Form\Handler\PunnetAnnonceHandler;

class BordController extends Controller
{
 	 // Affiche la page d'accueil du membre
	public function showUserBordAction()
	{	
		$securityContext = $this->container->get('security.context'); // Le controleur de sécurité
		
    	if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
    		return $this->redirect($this->generateUrl('fos_user_security_login'));
    	}
    	
    	$user = $securityContext->getToken()->getUser(); // L'id de l'utilisateur
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$annonces 	= $this->getAnnoncesAndFollowed($user, $em);
    	$nb_abonnes = $em->getRepository('PunnetSiteBundle:Abonnement\UserAbonnement')->countFollowers($user);    	
    	$nb_sold	= $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->countSold($user);
    	
    	return $this->render('PunnetSiteBundle:Bord:UserBord/UserBord.html.twig', array('annonces'   => $annonces, 
    																					'nb_abonnes' => $nb_abonnes,
    																					'nb_sold' 	 => $nb_sold ));	
	}
	
	// Affiche la page des annonces
	public function showUserAnnonceAction()
	{
		$securityContext = $this->container->get('security.context'); // Le controleur de sécurité
		
    	if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
    		return $this->redirect($this->generateUrl('fos_user_security_login'));
    	}
    	
    	$user	= $securityContext->getToken()->getUser();
    	
		$em = $this->getDoctrine()->getManager();
		$annonces = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->findBy(array('user' => $user) , 
																				   array('date' => 'DESC') 
																				   );
		
		return $this->render('PunnetSiteBundle:Bord:Annonce/UserAnnonce.html.twig', array('annonces' => $annonces));
	}
	
	// Affiche la page de dépose d'annonce
    public function depotAnnonceAction()
    {
    	$securityContext = $this->container->get('security.context'); // Le controleur de sécurité
		
    	if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
    		return $this->redirect($this->generateUrl('fos_user_security_login'));
    	}
    		// Initialisation du processus
	    	$annonce = new Annonce;
	    	$request       	= $this->get('request'); // La requete
			$entityManager  = $this->getDoctrine()->getManager(); // L'entityManager
	    	$user	= $securityContext->getToken()->getUser(); // L'utilisateur courant
	    	$annonce = $annonce->setDepartement($user->getDepartement()) // Les données utilisateur
	    					   ->setRegion($user->getRegion())
	    					   ->setVille($user->getVille());
		    $form = $this->createForm(new PunnetAnnonceType(), $annonce); // Le formulaire
	    	
	    	// On transmet le tout au AnnonceHandler
	    	$formHandler 	= new PunnetAnnonceHandler($form, $request, $entityManager, $annonce, $user); 
			
			// Validation du formulaire
			$process 		= $formHandler->process(); 
	    	
	    	// On envoie le tout a la validation via le AnnonceHandler		
			if($process)
			{
				// Launch the message flash
	            $this->get('session')->getFlashBag()->add('notice','Votre annonce à bien été enregistré');
	            	
				return $this->redirect(($this->generateUrl('punnet_showUserAnnonce')));
									 	 //array( 'region' 	  => $user->getRegion()->getSlug(), 
												//'departement' => $user->getDepartement()->getslug(), 
											    //'ville' 	  => $user->getVille()->getslug(), 
											    //'id' 		  => $annonce->getId(), 
											    //'slug' 		  => $annonce->getSlug()))));				
			}
	    	
		   return $this->render('PunnetSiteBundle:Depot:annonce.html.twig', array('form'        => $form->createView(), 																				  'add_annonce' => TRUE));
    }

	// Affiche la page de modification d'annonce
	public function editUserAnnonceAction($id)
	{
    	$securityContext = $this->container->get('security.context'); // Le controleur de sécurité
		
    	if(!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
    		return $this->redirect($this->generateUrl('fos_user_security_login'));
    	}
    		// Initialisation du processus
	    	$annonce = 		$this->getDoctrine()->getManager()->getRepository('PunnetSiteBundle:Annonce\Annonce')->find($id);	
	    	
	    	$request       	= $this->get('request'); // La requete
			$entityManager  = $this->getDoctrine()->getManager(); // L'entityManager
	    	$user	= $securityContext->getToken()->getUser(); // L'utilisateur courant
	    
		    $form = $this->createForm(new PunnetAnnonceType(), $annonce); // Le formulaire
	    	
	    	// On transmet le tout au AnnonceHandler
	    	$formHandler 	= new PunnetAnnonceHandler($form, $request, $entityManager, $annonce, $user); 
			
			// Validation du formulaire
			$process 		= $formHandler->updateProcess(); 
	    	
	    	// On envoie le tout a la validation via le AnnonceHandler		
			if($process)
			{
				// Launch the message flash
	            $this->get('session')->getFlashBag()->add('notice','L\'annonce numéro '.$annonce->getId().' a bien été modifié');
	            	
				return $this->redirect(($this->generateUrl('punnet_showUserAnnonce')));
									 	 //array( 'region' 	  => $user->getRegion()->getSlug(), 
												//'departement' => $user->getDepartement()->getslug(), 
											    //'ville' 	  => $user->getVille()->getslug(), 
											    //'id' 		  => $annonce->getId(), 
											    //'slug' 		  => $annonce->getSlug()))));				
			}
	    	
		   return $this->render('PunnetSiteBundle:Depot:annonce.html.twig', array('form'        => $form->createView(), 																				  'add_annonce' => FALSE));
    }
	
	private function getAnnoncesAndFollowed($user, $em)
	{
		// Recherche des personnes que l'utilisateur ( $user )  suit
    	$followers = $em->getRepository('PunnetSiteBundle:Abonnement\UserAbonnement')->findByFollower($user);
    	$followeds = $em->getRepository('PunnetSiteBundle:Abonnement\RegionAbonnement')->findByUser($user);
		
		if($followers != NULL or $followeds != NULL)
		{	
			$f = array();
			$fregion = array();
			// On récupere uniquement les ID des followeds dans un tableau
			foreach ($followers as $n )
			{
				$f[] = $n->getUser()->getId();
			}
			
			foreach($followeds as $n )
			{
				$fregion[] = $n->getRegion()->getId();	
			}
			
			// On mix les résultats des followeds avec celui des utilisateurs
			$annonces = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->getFollowed($f, $user, $fregion);
		}
		else
		{	// On affiche que nos annonces.
    		$annonces  = $em->getRepository('PunnetSiteBundle:Annonce\Annonce')->findBy(array('user' 	 => $user),
    																			   		array('date' 	 => 'DESC'));
		}
		
		return $annonces;
	}
}
