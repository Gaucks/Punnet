<?php

namespace Punnet\SiteBundle\Form\Type\Annonce;

use Punnet\SiteBundle\Form\Annonce\AnnonceType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PunnetAnnonceType extends AnnonceType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('title', 'text', array('label'		=> 'Titre de l\'annonce', 'attr' => array( 
            											  'placeholder' => 'Un titre explicite est simple attire plus de monde...',
            											  'class' => 'depot'
            											 )) )
            ->add('description', 'textarea', array())
            ->add('price', 'text', array('label'		=> 'Tarif','required' => FALSE,
            											   'attr' => array( 
            											  'placeholder' => '1000€',
														  'class'		=> 'price'
            											 )))
            ->add('region','entity',array('required'		 	=> TRUE,
	            												   'class' 	        	=> 'PunnetSiteBundle:Region\Region',
																   'property' 	   		=> 'Region',
																   'label' 		   		=> 'Région:',
																   'empty_value'   		=> 'Choisissez votre Region...', 
															       'attr'		   		=> array('class' => 'locale')
															   ))
			->add('departement','entity', array('required'		 	=> TRUE,
	            												   'class' 	        	=> 'PunnetSiteBundle:Departement\Departement',
																   'property' 	   		=> 'departement',
																   'label' 		   		=> 'Département:',
																   'empty_value'   		=> 'Choisissez votre département...', 
															       'attr'		   		=> array('class' => 'locale')
															   ))												
            ->add('ville','entity', array('required'		 	=> TRUE,
	            												   'class' 	        	=> 'PunnetSiteBundle:Ville\Ville',
																   'property' 	   		=> 'ville',
																   'label' 		   		=> 'Ville:',
																   'empty_value'   		=> 'Choisissez votre ville...', 
															       'attr'		   		=> array('class' => 'locale')
															   ))
			->add('categorie', 	'entity', array('class' 		=>'PunnetSiteBundle:Categorie\Categorie',
					 											  'property' 			=> 'categorie',
					 											  'group_by' 			=> 'parentcategorie.parent',
					 											  'empty_value' 		=> 'Choisissez votre catégorie...',
					 											  'label' 				=> 'Categorie',
					 											  'attr' 				=> array('class' => 'cat')
				 											  ))
        	->remove('date')
        	->remove('updated');
        
    }
}
